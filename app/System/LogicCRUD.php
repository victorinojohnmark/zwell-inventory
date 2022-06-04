<?php

namespace App\System;
use Illuminate\Support\Facades\Validator;
// use App\System\LogicCONF;

class LogicCRUD
{

    public static function createRecord($record_type, $namespace)
    {
        $record_type = "App"."\\".$namespace."\\".$record_type;
        return new $record_type();
    }

    public static function retrieveRecord($record_type, $namespace, $id = NULL, $limitter = null)
    {
        $record_type = "App"."\\".$namespace."\\".$record_type;

        if (!is_null($limitter)) {
            return is_null($id)? $record_type::orderBy('created_at', 'desc')->limit($limitter)->get() : $record_type::find($id);
        } else {
            return is_null($id)? $record_type::latest()->get() : $record_type::find($id);
        }
         
    }

    public static function saveRecord($model, $namespace, $values, $id = null, $event = null, $successview = null) 
    {
        $record_type = "App"."\\".$namespace."\\".$model;
        $record = new $record_type();
        $success = false;   
        
        //update validation rules upon update request
        switch ($model) {
            case 'Company':
                $record->validationrules['company_name'] = 'required|max:255';
                $record->validationrules['company_code'] = 'nullable|max:50';
                break;
            
            case 'Supplier':
                $record->validationrules['supplier_name'] = 'required|max:255';
                $record->validationrules['supplier_code'] = 'nullable|max:50';
                break;

            case 'Location':
                $record->validationrules['location_name'] = 'required|max:255';
                $record->validationrules['location_code'] = 'nullable|max:50';
                break;

            case 'Item':
                $record->validationrules['item_name'] = 'required|max:255';
                $record->validationrules['item_code'] = 'nullable|max:50';
                break;

            case 'Contractor':
                $record->validationrules['contractor_name'] = 'required|max:255';
                $record->validationrules['contractor_code'] = 'nullable|max:50';
                break;

            default:
                # code...
                break;
        }

        $validator = Validator::make($values, $record->validationrules, $record->validationmessages);

        if (!$validator->fails()){
            if (is_null($id)){
                $record = $record_type::createRecord($values);
            }
            else {
                $record = $record_type::find($id);
                $record->fill($values);
                $record->save();
            }

            //trigger event
            if(!is_null($event)) {
                $record_type::fireModelEvent($event);
            }
            $success = true;
        } 
        return array($validator, $record, $success);  
        
    }

    public static function deleteRecord()
    {

    }


}