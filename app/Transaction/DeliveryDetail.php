<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\Delivery;
use App\Transaction\PurchaseOrderDetail;
use App\Master\Item;

class DeliveryDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbt_delivery_details';

    protected $fillable = [
        'delivery_id', 'item_id', 'purchase_order_detail_id','quantity',  'unit_price','unit_cost', 'notes' 
    ];

    public $validationrules = [
        'delivery_id' => 'required|numeric', 
        'item_id' => 'required|numeric', 
        'purchase_order_detail_id' => 'required|numeric',
        'quantity' => 'required|numeric',  
        'unit_price' => 'required|numeric', ## 'unit_cost' => ['required', 'numeric', 'regex:^(?:[1-9]\d+|\d)(?:\.\d\d)?$^'],
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        'quantity.regex' => 'Maximum of 2 digit after decimal point at Quantity input',
        'unit_price.regex' => 'Maximum of 2 digit after decimal point at Unit Cost input',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'delivery_id' => $values['delivery_id'],
            'item_id' => $values['item_id'], 
            'purchase_order_detail_id' => $values['purchase_order_detail_id'],
            'quantity' => $values['quantity'],  
            'unit_price' => $values['unit_price'], 
            'notes' => $values['notes']
        ]);

    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function purchaseOrderDetail()
    {
        return $this->belongsTo(PurchaseOrderDetail::class);
    }
    
    public function getSubTotalAttribute()
    {
        return $subtotal = $this->unit_price * $this->quantity;
    }

    public function getIsDeliveryItemExistAttribute($deliveryID, $itemID) 
    {
        return $this::where('delivery_id', $deliveryID)
                    ->where('item_id', $itemID)
                    ->exists();
    }

}
