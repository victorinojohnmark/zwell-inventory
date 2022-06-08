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
        'purchase_order_id', 'supplier_id', 'dr_no', 'delivery_date', 'total_amount', 'recieved_by', 'notes'
    ];

    public $validationrules = [];

    public $validationmessages = [];

    public static function createRecord($values): self
    {
        return self::create([
            'purchase_order_id' => $values['purchase_order_id'], 
            'supplier_id' => $values['supplier_id'], 
            'dr_no' => $values['dr_no'], 
            'delivery_date' => $values['delivery_date'], 
            'total_amount' => $values['total_amount'], 
            'recieved_by' => $values['recieved_by'], 
            'notes' => $values['notes'],
        ]);

    }


}
