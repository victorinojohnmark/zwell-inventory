<?php

namespace App\Http\Controllers;

use App\System\FileAttachment;
use Illuminate\Http\Request;

class UploadController extends Controller
{
        //FileUpload
        public function uploadpo(Request $request, $transactionType, $transactionID, $userID){

            
            if($request->hasFile('file')){
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $folder = uniqid() . '-' . now()->timestamp;
                $file->storeAs('uploads/fileattachments/' . $folder, $filename);
    
                //insert DB here
                FileAttachment::create([
                    'transaction_type' => $transactionType,
                    'transaction_id' => $transactionID,
                    'prepared_by_id' => $userID,
                    'folder_name' => $folder,
                ]);

                return $folder;
            }
            return '';
        }
}
