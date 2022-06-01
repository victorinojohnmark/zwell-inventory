<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'tbm_suppliers';

    protected $fillable = [
        'supplier_name', 'supplier_code', 'contact_person', 'contact_no', 'email', 'address', 'notes'
    ];

    public $validationrules = [
        'supplier_name' => 'required|max:255|unique:tbm_suppliers', 
        'supplier_code' => 'required|max:50|unique:tbm_suppliers', 
        'contact_person' => 'required|max:50', 
        'contact_no' => 'required|max:50', 
        'email' => 'nullable|email|max:50', 
        'address' => 'nullable|max:255', 
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [
        
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'supplier_name' => $values['supplier_name'], 
            'supplier_code' => $values['supplier_code'], 
            'contact_person' => $values['contact_person'], 
            'contact_no' => $values['contact_no'], 
            'email' => $values['email'], 
            'address' => $values['address'], 
            'notes' => $values['notes'],
        ]);

    }
}
