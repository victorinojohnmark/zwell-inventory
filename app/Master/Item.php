<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbm_items';

    protected $fillable = [
        'item_name', 'item_code', 'description', 'unit', 'minimum_stock_qty', 'notes', 'active'
    ];

    public $validationrules = [
        'item_name' => 'required|max:255|unique:tbm_items', 
        'item_code' => 'nullable|max:50|unique:tbm_items', 
        'description' => 'nullable|max:255',
        'unit'   => 'required|max:50', 
        'minimum_stock_qty' => 'required|numeric',
        'notes' => 'nullable|max:255',
        'active' => 'required|max:30'
    ];

    public $validationmessages = [
        'minimum_stock_qty.required' => 'Minimum Stock QTY field is required',
        'minimum_stock_qty.numeric' => 'Invalid Minimum Stock QTY entry',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'item_name' => $values['item_name'], 
            'item_code' => $values['item_name'],
            'description' => $values['description'], 
            'unit'   => $values['unit'],
            'minimum_stock_qty' => $values['minimum_stock_qty'],
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }

    public function getTotalDeliveryCompletedAttribute()
    {
        return $count = DB::table('tbm_items')
                ->join('tbt_delivery_details', 'tbm_items.id', '=', 'tbt_delivery_details.item_id')
                ->leftJoin('tbt_deliveries', 'tbt_delivery_details.delivery_id', '=', 'tbt_deliveries.id')
                ->where([['tbm_items.id', '=', $this->id],['tbt_deliveries.complete_status', '=', 1],['tbt_deliveries.approved_by_id', '!=', 0]])
                ->whereNull('tbt_delivery_details.deleted_at')
                // ->select('tbm_items.*', 'tbt_delivery_details.id as dr_detail_id', 'tbt_delivery_details.quantity')
                // ->get();
                ->sum('tbt_delivery_details.quantity');
    }

    public function getTotalDeliveryEntriesAttribute()
    {
        return $count = DB::table('tbm_items')
                ->join('tbt_delivery_details', 'tbm_items.id', '=', 'tbt_delivery_details.item_id')
                ->leftJoin('tbt_deliveries', 'tbt_delivery_details.delivery_id', '=', 'tbt_deliveries.id')
                ->where('tbm_items.id', '=', $this->id)
                ->whereNull('tbt_delivery_details.deleted_at')
                // ->select('tbm_items.*', 'tbt_delivery_details.id as dr_detail_id', 'tbt_delivery_details.quantity')
                // ->get();
                ->sum('tbt_delivery_details.quantity');
    }

    public function getTotalReleasesAttribute()
    {
        return $count = DB::table('tbm_items')
                ->join('tbt_release_details', 'tbm_items.id', '=', 'tbt_release_details.item_id')
                ->leftJoin('tbt_releases', 'tbt_release_details.release_id', '=', 'tbt_releases.id')
                ->where([['tbm_items.id', '=', $this->id],['tbt_deliveries.complete_status', '=', 1],['tbt_deliveries.approved_by_id', '!=', 0]])
                ->whereNull('tbt_delivery_details.deleted_at')
                ->sum('tbt_delivery_details.quantity');
    }


}
