<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use App\System\LogicCRUD;
use App\Master\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:user-view', ['only' => ['userview']]);
        $this->middleware('permission:user-create', ['only' => ['usercreate']]);
        $this->middleware('permission:user-save', ['only' => ['usersave']]);
        $this->middleware('permission:user-resetpassword', ['only' => ['userresetpassword']]);
    }

    public function userview(Request $request)
    {
        if(isset($request->id)) {
            return view('system.user.userform', [
                'user' => LogicCRUD::retrieveRecord('User', 'Master', $request->id),
                'roles' => Role::pluck('name','name')->all()
            ]);
        } 

        else {
            return view('system.user.userlist', [
                'users' => LogicCRUD::retrieveRecord('User', 'Master', null)
            ]);
        }
    }

    public function usercreate()
    {
        return view('system.user.userform', [
            'user' => LogicCRUD::createRecord('User', 'Master'),
            'roles' => Role::pluck('name','name')->all()
        ]);
    }

    public function usersave(Request $request)
    {
        $validations = ['name' => 'required','username' => 'required','email' => 'required|email', 'password' => 'min:6|required_with:confirm_password|same:confirm_password', 'confirm_password' => 'min:6'];
        if($request->id) {
            unset($validations['password']);
            unset($validations['confirm_password']);
        }
        
        $validator = Validator::make($request->all(), $validations, []);

        if (!$validator->fails()){
            if (is_null($request->id)){

                $hashPassword = Hash::make($request->input('password'));

                $user = User::create([
                    'name' => $request->input('name'), 
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $hashPassword
                ]);

                $user->assignRole($request->input('roles'));
            }
            else {
                $user = User::find($request->id);
                $user->name = $request->input('name');
                $user->username = $request->input('username');
                $user->email = $request->input('email');
                $user->save();

                DB::table('model_has_roles')->where('model_id', $user->id)->delete();
                $user->assignRole($request->input('roles'));
            }

            return redirect()->route('userview');

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function userresetpassword(Request $request)
    {
        $validations = ['password' => 'min:6|required_with:confirm_password|same:confirm_password', 'confirm_password' => 'min:6'];
        
        $validator = Validator::make($request->all(), $validations, []);

        if (!$validator->fails()){
            $hashPassword = Hash::make($request->input('password'));

            $user = User::find($request->id);
            $user->password = $hashPassword;
            $user->save();

            return redirect()->route('userview')->with('success', 'Password reset successful');

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}