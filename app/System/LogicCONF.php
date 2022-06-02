<?php

namespace App\System;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LogicCONF
{
    public static function getDropDownJson($file_name)
    {
        $lists = Storage::disk('json')->exists($file_name)? Storage::disk('json')->get($file_name) : '';
        return json_decode($lists, true);
    }

    public static function defaultInt($value)
    {
        return $value? $value : 0;
    }

    public static function defaultFloat()
    {
        return $value? $value : 0.0;
    }

    public static function formatDate($date)
    {
        return $date? Carbon::parse($date)->format('Y-m-d') : NULL;
    }

}