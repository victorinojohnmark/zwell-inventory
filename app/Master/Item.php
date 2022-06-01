<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbm_items';

    protected $fillable = [
        'item_name', 'item_code', 'description', 'unit_id', 'minimum_stock_qty', 'notes', 'active'
    ];

    public $validationrules = [
        'item_name' => 'required|max:255|unique:tbm_items', 
        'item_code' => 'nullable|max:50|unique:tbm_items', 
        'description' => 'nullable|max:255',
        'unit_id'   => 'required|numeric', 
        'minimum_stock_qty' => 'required|numeric',
        'notes' => 'nullable|max:255',
        'active' => 'nullable|numeric'
    ];

    public $validationmessages = [
        'unit_id.required' => 'Unit field is required',
        'unit_id.numeric' => 'Invalid unit entry',
        'minimum_stock_qty.required' => 'Minimum Stock QTY field is required',
        'minimum_stock_qty.numeric' => 'Invalid Minimum Stock QTY entry',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'item_name' => $values['item_name'], 
            'item_code' => $values['item_name'],
            'description' => $values['description'], 
            'unit_id'   => $values['unit_id'],
            'minimum_stock_qty' => $values['minimum_stock_qty'],
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }
}
