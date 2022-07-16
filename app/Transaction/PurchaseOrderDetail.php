<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\PurchaseOrder;
use App\Transaction\DeliveryDetail;
use App\Master\Item;


class PurchaseOrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbt_purchase_order_details';

    protected $fillable = [
        'purchase_order_id', 'item_id', 'quantity',  'unit_cost', 'notes' 
    ];

    public $validationrules = [
        'purchase_order_id' => 'required|numeric', 
        'item_id' => 'required|numeric', 
        'quantity' => 'required|numeric',  
        'unit_cost' => 'required|numeric', ## 'unit_cost' => ['required', 'numeric', 'regex:^(?:[1-9]\d+|\d)(?:\.\d\d)?$^'],
        
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        'quantity.regex' => 'Maximum of 2 digit after decimal point at Quantity input',
        'unit_cost.regex' => 'Maximum of 2 digit after decimal point at Unit Cost input',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'purchase_order_id' => $values['purchase_order_id'], 
            'item_id' => $values['item_id'], 
            'quantity' => $values['quantity'],  
            'unit_cost' => $values['unit_cost'], 
            'notes' => $values['notes']
        ]);

    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function deliveryDetails()
    { 
        return $this->hasMany(DeliveryDetail::class);
    }

    public function delivery_detail_entries_completed()
    {
        return DB::table('tbt_delivery_details')
               ->join('tbt_deliveries', 'tbt_delivery_details.delivery_id', '=', 'tbt_deliveries.id')
               ->join('tbt_purchase_order_details', 'tbt_purchase_order_details.id', '=', 'tbt_delivery_details.purchase_order_detail_id')
               ->where([
                ['tbt_deliveries.complete_status', '=', 1],
                ['tbt_purchase_order_details.id', '=', $this->id]
               ])
               ->whereNull('tbt_delivery_details.deleted_at')
               ->select('tbt_delivery_details.*')
               ->get();
    }

    public function getSubTotalAttribute()
    {
        return $subtotal = $this->unit_cost * $this->quantity;
    }

    // public function deliveries()
    // {
    //     return $this->HasManyThrough(Delivery::class, PurchaseOrder::class);
    // }

    // public function 

    // public function deliveryDetails()
    // {
    //     return DB::table('tbt_delivery_details')
    //            ->join('tbt_deliveries', 'tbt_delivery_details.delivery_id', '=', 'tbt_deliveries.id')
    //            ->where([
    //             ['tbt_deliveries.complete_status', '=', 1]
    //             ])
    // }

    public function getItemNameAttribute() 
    {
        return $total = $this->item->item_name;
    }

}
