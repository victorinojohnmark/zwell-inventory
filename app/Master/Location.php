<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbm_locations';

    protected $fillable = [
        'location_name', 'location_code', 'contact_person', 'contact_no', 'email', 'address', 'notes', 'active'
    ];

    public $validationrules = [
        'location_name' => 'required|max:255|unique:tbm_locations', 
        'location_code' => 'nullable|max:50|unique:tbm_locations', 
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
            'location_name' => $values['location_name'], 
            'location_code' => $values['location_name'], 
            'contact_person' => $values['contact_person'], 
            'contact_no' => $values['contact_no'], 
            'email' => $values['email'], 
            'address' => $values['address'], 
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }
}
