<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\System\LogicCRUD;
use App\System\Permission;

class RoleController extends Controller
{
    function __construct() 
    {
        $this->middleware('permission:role-view', ['only' => ['roleview']]);
        $this->middleware('permission:role-create', ['only' => ['rolecreate']]);
        $this->middleware('permission:role-save', ['only' => ['rolesave']]);
    }

    public function roleview(Request $request)
    {
        if(isset($request->id)) {
            return view('system.role.roleform', [
                'role' => LogicCRUD::retrieveRecord('Role', 'System', $request->id),
                'permissions' => Permission::all()
            ]);
        } 

        else {
            return view('system.role.rolelist', [
                'roles' => LogicCRUD::retrieveRecord('Role', 'System', null)
            ]);
        }
    }

    public function rolecreate()
    {
        return view('system.role.roleform', [
            'role' => LogicCRUD::createRecord('Role', 'System'),
            'permissions' => Permission::all()
            
        ]);
    }

    public function rolesave(Request $request)
    {
        $validations = ['name' => 'required','description' => 'nullable','permission' => 'required'];
        $validator = Validator::make($request->all(), $validations, []);

        // dd($request);
        if (!$validator->fails()){
            if (is_null($request->id)){
                $role = \Spatie\Permission\Models\Role::create(['name' => $request->input('name'), 'description' => $request->input('description')]);
                $role->syncPermissions($request->input('permission'));
            }
            else {
                $role = \Spatie\Permission\Models\Role::find($request->id);
                $role->name = $request->input('name');
                $role->description = $request->input('description');
                $role->save();
            
                $role->syncPermissions($request->input('permission'));
            }

            return redirect()->route('roleview')->with('success', 'Role Updated');;

        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }

    }
}
