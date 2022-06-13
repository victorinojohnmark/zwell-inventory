<?php

namespace App\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\PurchaseOrder;

class FileAttachment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tbs_file_attachments';

    protected $fillable = [
        'transaction_type',
        'transaction_id',
        'uploaded_by_id',
        'original_filename',
        'filename'
    ];

    public $validationrules = [
        'fileAttachment' => 'required|max:20000|mimes:doc,docx,pdf,xls,xlsx,jpg,jpeg,png,gif',
        'transaction_type' => 'required|max:20',
        'transaction_id' => 'required|integer',
        'uploaded_by_id' => 'required|integer',
        'original_filename' => 'required|max:255',
        'filename' => 'required|max:255',
    ];

    public $validationmessages = [];

    public static function createRecord($values): self
    {
        return self::create([
            'transaction_type' => $values['transaction_type'],
            'transaction_id' => $values['transaction_id'],
            'uploaded_by_id' => $values['uploaded_by_id'],
            'original_filename' => $values['original_filename'],
            'filename' => $values['filename'],
        ]);

    }

}
