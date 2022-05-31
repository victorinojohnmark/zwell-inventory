<?php

namespace App\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbm_companies';

    protected $fillable = [
        'company_name', 'company_code', 'contact_person', 'contact_no', 'email', 'address', 'notes', 'active'
    ];

    public $validationrules = [
        'company_name' => 'required|max:255|unique:tbm_companies', 
        'company_code' => 'nullable|max:50|unique:tbm_companies', 
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
            'company_name' => $values['company_name'], 
            'company_code' => $values['company_name'], 
            'contact_person' => $values['contact_person'], 
            'contact_no' => $values['contact_no'], 
            'email' => $values['email'], 
            'address' => $values['address'], 
            'notes' => $values['notes'],
        ]);

    }

    

}
