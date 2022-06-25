<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\PurchaseOrder;
use App\Transaction\Delivery;
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

    public function getSubTotalAttribute()
    {
        return $subtotal = $this->unit_cost * $this->quantity;
    }

    public function deliveries()
    {
        return $this->HasManyThrough(Delivery::class, PurchaseOrder::class);
    }

    public function getTotalDeliveredItemsAttribute($itemID)
    {
        return $deliveries = $this->purchaseOrder->deliveries;
    }


}
