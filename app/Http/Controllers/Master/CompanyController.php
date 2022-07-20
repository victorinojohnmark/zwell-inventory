<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Model\Company;

use App\System\LogicCRUD;

class CompanyController extends Controller
{

    function __construct() 
    {
        $this->middleware('permission:company-view', ['only' => ['companyview']]);
        $this->middleware('permission:company-create', ['only' => ['companycreate']]);
        $this->middleware('permission:company-save', ['only' => ['companysave']]);
    }

    public function companyview(Request $request)
    {
        if(isset($request->id)) {
            return view('master.company.companyform', [
                'company' => LogicCRUD::retrieveRecord('Company', 'Master', $request->id)
            ]);
        } 

        else {
            return view('master.company.companylist', [
                'companies' => LogicCRUD::retrieveRecord('Company', 'Master', null)
            ]);
        }
    }

    public function companycreate()
    {
        return view('master.company.companyform', [
            'company' => LogicCRUD::createRecord('Company', 'Master'),
        ]);
    }

    public function companysave(Request $request)
    {
        // adjust active value
        $request['active'] = $request['active'] ? 1 : 0;

        //logo file
        if($request->hasFile('logo')) {

            $file = $request->file('logo');
            $fileExtension = $file->guessExtension();
            $fileName = uniqid() . now()->timestamp . '.' . $fileExtension;
            $request['logo_filename'] = $fileName;
            // array_push($request, ['logo_filename' => $fileName]);
        }
          
        list($validator, $record, $success) = LogicCRUD::saveRecord('Company', 'Master', $request->all(), $request->id, $request->id ? 'updated' : 'created');

        if ($success){
            $request->hasFile('logo') ?  $file->storeAs('public/company/', $fileName) : null;
            return redirect()->route('companyview');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function companydelete()
    {

    }
}
