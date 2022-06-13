<?php

namespace App\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileAttachment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tbs_file_attachments';

    protected $fillable = [
        'transaction_type',
        'transaction_id',
        'prepared_by_id',
        'folder_name'
    ];

}
