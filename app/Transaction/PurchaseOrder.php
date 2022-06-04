<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tbt_purchase_orders";

    protected $fillable = [
        'po_no', 'transaction_code', 'requisition_slip_no',
        'contractor_id', 'supplier_id', 
        'purchase_date', 'purchase_cost', 'prepared_by_id', 'notes'
    ];

    public $validationrules = [
        'po_no' => 'required|numeric|unique:tbt_purchase_order', 
        'transaction_code' => 'nullable|max:20|unique:tbt_purchase_orders', 
        'requisition_slip_no' => 'required|max:20',
        'contractor_id' => 'required|integer', 
        'supplier_id' => 'required|integer', 
        'purchase_date' => 'required|date', 
        'purchase_cost' => 'nullable|numeric', 
        'prepared_by_id' => 'required|integer', 
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'po_no' => $values['po_no'], 
            'transaction_code' => $values['transaction_code'], 
            'requisition_slip_no' => $values['requisition_slip_no'],
            'contractor_id' => $values['contractor_id'], 
            'supplier_id' => $values['supplier_id'], 
            'purchase_date' => $values['purchase_date'], 
            'purchase_cost' => $values['purchase_cost'], 
            'prepared_by_id' => $values['prepared_by_id'], 
            'notes' => $values['notes'],
        ]);

    }
}
