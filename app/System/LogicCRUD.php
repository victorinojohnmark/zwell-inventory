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

    public static function retrieveRecord($record_type, $namespace, $id = NULL, $limitter = null, $active = false)
    {
        $record_type = "App"."\\".$namespace."\\".$record_type;

        if (!is_null($limitter)) {
            return is_null($id)? $record_type::orderBy('created_at', 'desc')->limit($limitter)->get() : $record_type::find($id);
        } else {
            if($active) {
                return is_null($id)? $record_type::where('active','1')->latest()->get() : $record_type::find($id);
                
            } else {
                return is_null($id)? $record_type::latest()->get() : $record_type::find($id);
            }
            
        }
         
    }

    public static function saveRecord($model, $namespace, $values, $id = null, $event = null) 
    {
        $record_type = "App"."\\".$namespace."\\".$model;
        $record = new $record_type();
        $success = false;   

        ## Checking if id exist, true result - meaning update transaction
        if(!is_null($id)) {
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

                case 'PurchaseOrder':
                    $record->validationrules['po_no'] = 'required|max:20';
                    unset($values['transaction_code']); //exclude transaction_code upon update request
                    unset($values['prepared_by_id']);   //exclude prepared_by_id upon update request
                    break;

                default:
                    # code...
                    break;
            }
        }

        // dd($values);

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

    public static function deleteRecord($model, $namespace, $id = null)
    {
        
    }


}