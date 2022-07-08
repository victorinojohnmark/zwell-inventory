<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Master\Company;
use App\Master\Contractor;
use App\Master\Supplier;
use App\Master\Location;
use App\Master\Item;

use App\Transaction\PurchaseOrderDetail;
use App\Transaction\Delivery;


use App\System\FileAttachment;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbt_purchase_orders';

    protected $fillable = [
        'po_no', 'transaction_code', 'requisition_slip_no',
        'company_id', 'contractor_id', 'supplier_id', 'location_id',
        'purchase_date', 'purchase_cost', 'prepared_by_id', 'purpose', 'terms', 'notes'
    ];

    public $validationrules = [
        'po_no' => 'required|max:20|unique:tbt_purchase_orders', 
        'transaction_code' => 'nullable|max:20|unique:tbt_purchase_orders', 
        'requisition_slip_no' => 'required|max:20',
        'company_id' => 'required|integer', 
        'contractor_id' => 'required|integer', 
        'supplier_id' => 'required|integer', 
        'location_id' => 'required|integer',
        'purchase_date' => 'required|date', 
        'purchase_cost' => 'nullable|numeric', 
        'prepared_by_id' => 'nullable|integer',
        'purpose' => 'nullable|max:255',
        'terms' => 'nullable|max:50', 
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        'po_no.required' => 'PO No is required',
        'po_no.unique'  => 'PO No is already used',

        'requisition_slip_no.required' => 'Requisition No is required',

        'company_id.required' => 'Company is required',
        'company_id.integer' => 'Company is required',

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
            'company_id' => $values['company_id'], 
            'contractor_id' => $values['contractor_id'], 
            'supplier_id' => $values['supplier_id'], 
            'location_id' => $values['location_id'],
            'purchase_date' => $values['purchase_date'], 
            'purchase_cost' => $values['purchase_cost'], 
            'prepared_by_id' => $values['prepared_by_id'], 
            'purpose' => $values['purpose'], 
            'terms' => $values['terms'],
            'notes' => $values['notes']
        ]);

    }

    public function company()
    {
        return $this->belongsTo(Company::class);
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

    public function items() 
    {
        return $this->hasManyThrough(Item::class, PurchaseOrderDetail::class);
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

    public function deliveryDetails()
    {
        return $this->hasManyThrough(DeliveryDetail::class, Delivery::class);
    }

    public function completedDeliveryDetails()
    {
        return $this->hasManyThrough(DeliveryDetail::class, Delivery::class)->where('tbt_deliveries.approved_by_id', '!=', '0');
    }

    public function total_delivery_per_item($itemID)
    {
        return $this->deliveryDetails->where('item_id', $itemID)->sum('quantity');
    }

    public function total_completed_delivery_per_item($itemID)
    {
        return $this->completedDeliveryDetails->where('item_id', $itemID)->sum('quantity');
    } 

    public function getCompletedDeliveryAttribute()
    {
        return $this->deliveryDetails->where('complete_status', 1)->get();
    }

    public function getStatusAttribute()
    {
        $status = array();
        if($this->complete_status && $this->approved_by_id == 0) {
            $status = ['state' => 'danger', 'title' => 'Pending for approval'];
        } else {
            $status = ['state' => 'primary', 'title' => 'Approved'];
        }
        if($this->complete_status == 0 && $this->approved_by_id == 0) {
            $status = ['state' => 'warning', 'title' => 'Draft'];
        }

        return $status;

    }

    
}
