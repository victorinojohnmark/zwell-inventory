<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Master\Contractor;
use App\Master\Supplier;
use App\Master\Location;

use App\Transaction\PurchaseOrderDetail;
use App\Transaction\Delivery;

use App\System\FileAttachment;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbt_purchase_orders';

    protected $fillable = [
        'po_no', 'transaction_code', 'requisition_slip_no',
        'contractor_id', 'supplier_id', 'location_id',
        'purchase_date', 'purchase_cost', 'prepared_by_id', 'purpose', 'notes'
    ];

    public $validationrules = [
        'po_no' => 'required|max:20|unique:tbt_purchase_orders', 
        'transaction_code' => 'nullable|max:20|unique:tbt_purchase_orders', 
        'requisition_slip_no' => 'required|max:20',
        'contractor_id' => 'required|integer', 
        'supplier_id' => 'required|integer', 
        'location_id' => 'required|integer',
        'purchase_date' => 'required|date', 
        'purchase_cost' => 'nullable|numeric', 
        'prepared_by_id' => 'nullable|integer',
        'purpose' => 'nullable|max:255', 
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        'po_no.required' => 'PO No is required',
        'po_no.unique'  => 'PO No is already used',

        'requisition_slip_no.required' => 'Requisition No is required',

        'contractor_id.required' => 'Contractor is required',
        'contractor_id.integer' => 'Contractor is required',

        'supplier_id.required' => 'Supplier is required',
        'supplier_id.integer' => 'Supplier is required',

        'location_id.required' => 'Location is required',
        'location_id.integer' => 'Location is required',
        
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'po_no' => $values['po_no'], 
            'transaction_code' => $values['transaction_code'], 
            'requisition_slip_no' => $values['requisition_slip_no'],
            'contractor_id' => $values['contractor_id'], 
            'supplier_id' => $values['supplier_id'], 
            'location_id' => $values['location_id'],
            'purchase_date' => $values['purchase_date'], 
            'purchase_cost' => $values['purchase_cost'], 
            'prepared_by_id' => $values['prepared_by_id'], 
            'purpose' => $values['purpose'], 
            'notes' => $values['notes']
        ]);

    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function purchaseOrderDetails() 
    {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }

    public function fileAttachments()
    {
        // return $this->hasMany(FileAttachment::class)->where('transaction_type','purchase_order');
        return $this->hasMany(FileAttachment::class, 'transaction_id')->where(['transaction_type' => 'purchase_order', 'transaction_id' => $this->id]);
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach ($this->purchaseOrderDetails as $purchaseOrderDetail) {
            $total += $purchaseOrderDetail->SubTotal;
        }

        return $total;
    }

    public function getTotalDeliveriesAttribute($itemID)
    {
        return $this->hasManyThrough(DeliveryDetail::class, Delivery::class);
    }

    public function getTotalDeliveredItemsAttribute($itemID)
    {
        return $this->TotalDeliveries->where('item_id', $itemID)->sum('quantity');
    } 

    
}
