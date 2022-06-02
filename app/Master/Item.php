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
        'item_name', 'item_code', 'description', 'unit', 'minimum_stock_qty', 'notes', 'active'
    ];

    public $validationrules = [
        'item_name' => 'required|max:255|unique:tbm_items', 
        'item_code' => 'nullable|max:50|unique:tbm_items', 
        'description' => 'nullable|max:255',
        'unit'   => 'required|max:50', 
        'minimum_stock_qty' => 'required|numeric',
        'notes' => 'nullable|max:255',
        'active' => 'required|max:30'
    ];

    public $validationmessages = [
        'minimum_stock_qty.required' => 'Minimum Stock QTY field is required',
        'minimum_stock_qty.numeric' => 'Invalid Minimum Stock QTY entry',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'item_name' => $values['item_name'], 
            'item_code' => $values['item_name'],
            'description' => $values['description'], 
            'unit'   => $values['unit'],
            'minimum_stock_qty' => $values['minimum_stock_qty'],
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }
}
