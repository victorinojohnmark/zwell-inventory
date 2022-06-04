<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;
    protected $table = 'tbm_contractors';

    protected $fillable = [
        'contractor_name', 'contractor_code', 'contact_person', 'contact_no', 'email', 'address', 'notes', 'active'
    ];

    public $validationrules = [
        'contractor_name' => 'required|max:255|unique:tbm_contractors', 
        'contractor_code' => 'required|max:50|unique:tbm_contractors', 
        'contact_person' => 'required|max:50', 
        'contact_no' => 'required|max:50', 
        'email' => 'nullable|email|max:50', 
        'address' => 'nullable|max:255', 
        'notes' => 'nullable|max:255',
        'active' => 'nullable|numeric'
    ];

    public $validationmessages = [
        
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'contractor_name' => $values['contractor_name'], 
            'contractor_code' => $values['contractor_code'], 
            'contact_person' => $values['contact_person'], 
            'contact_no' => $values['contact_no'], 
            'email' => $values['email'], 
            'address' => $values['address'], 
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }
}
