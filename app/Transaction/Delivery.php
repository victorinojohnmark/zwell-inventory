<?php

namespace App\Transaction;

use App\Master\Supplier;
use App\System\FileAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\DeliveryDetail;
use App\Transaction\PurchaseOrder;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tbt_deliveries";

    protected $fillable = [
        'transaction_code', 'purchase_order_id', 'dr_no','supplier_id' , 
        'delivery_date', 'total_amount','recieved_by', 'notes'
    ];

    public $validationrules = [
        'transaction_code' => 'nullable|max:20',
        'purchase_order_id' => 'required|numeric', 
        'dr_no' => 'required|max:20', 
        'supplier_id' => 'required|numeric',
        'delivery_date' => 'required|date',  
        'recieved_by' => 'required|max:255', 
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        'purchase_order_id.required' => 'Purchase Order No is required',
        'purchase_order_id.numeric' => 'Purchase Order No is required',
        'supplier_id.required' => 'Supplier is required',
        'supplier_id.numeric' => 'Supplier is required',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'transaction_code' => $values['transaction_code'],
            'purchase_order_id' => $values['purchase_order_id'], 
            'dr_no' => $values['dr_no'], 
            'supplier_id' => $values['supplier_id'], 
            'delivery_date' => $values['delivery_date'], 
            'total_amount' => $values['total_amount'],
            'recieved_by' => $values['recieved_by'], 
            'notes' => $values['notes']
        ]);

    }
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function deliveryDetails() 
    {
        return $this->hasMany(DeliveryDetail::class);
    }

    public function fileAttachments()
    {
        return $this->hasMany(FileAttachment::class, 'transaction_id')->where(['transaction_type' => 'delivery', 'transaction_id' => $this->id]);
    }

    public function getTotalAmountAttribute()
    {
        $total = 0;
        foreach ($this->deliveryDetails as $deliveryDetail) {
            $total += $deliveryDetail->SubTotal;
        }

        return $total;
    }

    public function TotalDeliveredItems($delivery_id)
    {
        
        return $this->deliveryDetails->where('delivery_id', $delivery_id);
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
