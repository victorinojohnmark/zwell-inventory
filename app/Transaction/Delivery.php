<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tbt_deliveries";

    protected $fillable = [
        'purchase_order_id', 'supplier_id', 'dr_no', 'delivery_date', 'recieved_by', 'notes'
    ];

    public $validationrules = [
        'purchase_order_id' => 'required|numeric', 
        'supplier_id' => 'required|numeric', 
        'dr_no' => 'required|max:20', 
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
            'purchase_order_id' => $values['purchase_order_id'], 
            'supplier_id' => $values['supplier_id'], 
            'dr_no' => $values['dr_no'], 
            'delivery_date' => $values['delivery_date'], 
            'recieved_by' => $values['recieved_by'], 
            'notes' => $values['notes'],
        ]);

    }


}
