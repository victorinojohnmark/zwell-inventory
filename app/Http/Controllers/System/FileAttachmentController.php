<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\System\FileAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\System\LogicCRUD;

use App\Transaction\PurchaseOrder;
use App\Transaction\Release;

class FileAttachmentController extends Controller
{
        //FileUpload
        public function fileattachmentupload(Request $request, $transactionType, $transactionID, $userID)
        {
            $m = $this->record($transactionType);
            $model = $m::findorFail($transactionID);
            if(!$model->complete_status) {
                if($request->hasFile('fileAttachment')){
                
                    $file = $request->file('fileAttachment');
                    $filename = $file->getClientOriginalName();
                    $fileExtension = $file->guessExtension();
                    $customFilename = uniqid() . now()->timestamp . '.' . $fileExtension;
    
                    $request['transaction_type'] = $transactionType;
                    $request['transaction_id'] = $transactionID;
                    $request['uploaded_by_id'] = $userID;
                    $request['original_filename'] = $filename;
                    $request['filename'] = $customFilename;
    
                    list($validator, $record, $success) = LogicCRUD::saveRecord('FileAttachment', 'System', $request->all(), $request->id, $request->id ? 'updated' : 'created');
    
                    if($success) {
                        $file->storeAs('public/fileattachments/' . $transactionType . '/', $customFilename);
                        return $record;
                    } else {
                        return response()->json($validator->messages(), 400);
                    }
                    
                }
                return response()->json(['Error' => 'Invalid file sumitted'], 400);
            } else {
                return response()->json(['Error' => 'Transaction invalid, '. $transactionType .' already completed.'], 400);
            }

            
        }

        //FileUpload
        public function fileattachmentdelete(Request $request, $fileid)
        {
            $fileAttachment = FileAttachment::findOrFail($fileid);
            $fileAttachment->delete();

            return redirect()->back();
        }
        
        public static function record($transactionType)
        {
            $transaction = $transactionType;
            switch ($transaction) {
                case 'purchase_order':
                    $record_type = "App\\Transaction\\PurchaseOrder";
                    $model = new $record_type();
                    return $model;
                    break;

                case 'delivery':
                    $record_type = "App\\Transaction\\Delivery";
                    $model = new $record_type();
                    return $model;
                    break;

                case 'release':
                    $record_type = "App\\Transaction\\Release";
                    $model = new $record_type();
                    return $model;
                    break;
                
                default:
                    # code...
                    break;
            }
        }
}
