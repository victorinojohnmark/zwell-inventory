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
        'company_name', 'company_code', 'logo_filename', 'contact_no', 'website', 'email', 'address', 'notes', 'active'
    ];

    public $validationrules = [
        'company_name' => 'required|max:255|unique:tbm_companies', 
        'company_code' => 'nullable|max:50|unique:tbm_companies',
        'logo_filename' => 'required|max:255', 
        'contact_no' => 'required|max:50',
        'website' => 'required|max:100', 
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
            'company_name' => $values['company_name'], 
            'company_code' => $values['company_code'], 
            'logo_filename' => $values['logo_filename'], 
            'contact_no' => $values['contact_no'], 
            'website' => $values['website'], 
            'email' => $values['email'], 
            'address' => $values['address'], 
            'notes' => $values['notes'],
            'active' => $values['active'],
        ]);

    }

    

}
