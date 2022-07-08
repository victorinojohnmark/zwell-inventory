<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Master\location;
use App\Master\Company;
use App\Master\Contractor;

use App\Transaction\ReleaseDetail;
use App\system\FileAttachment;

class Release extends Model
{
    use HasFactory;

    Protected $table = 'tbt_releases';

    protected $fillable = [
        'transaction_code', 
        'location_id', 
        'company_id', 
        'contractor_id', 
        'release_date', 
        'received_by',
        'notes'
    ];

    public $validationrules = [
        'transaction_code' => 'nullable|max:20', 
        'location_id' => 'required|integer', 
        'company_id' => 'required|integer', 
        'contractor_id' => 'required|integer', 
        'release_date' => 'required|date', 
        'received_by' => 'required|max:20',
        'notes' => 'nullable|max:255'
    ];

    public $validationmessages = [ 
        'location_id.required' => 'Location is required',
        'location_id.integer' => 'Location is required',  

        'company_id.required' => 'Company is required',
        'company_id.integer' => 'Company is required',

        'contractor_id.required' => 'Contractor is required',
        'contractor_id.integer' => 'Contractor is required',
    ];

    public static function createRecord($values): self
    {
        return self::create([
        'transaction_code' => $values['transaction_code'], 
        'location_id' => $values['location_id'], 
        'company_id' => $values['company_id'], 
        'contractor_id' => $values['contractor_id'], 
        'release_date' => $values['release_date'], 
        'received_by' => $values['received_by'],
        'notes' => $values['notes'],
        ]);
    }

    public function releaseDetails()
    {
        return $this->hasMany(ReleaseDetail::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contractor()
    {
        return $this->belongsTo(Contractor::class);
    }

    public function fileAttachments()
    {
        return $this->hasMany(FileAttachment::class, 'transaction_id')->where(['transaction_type' => 'release', 'transaction_id' => $this->id]);
    }

    public function getStatusAttribute()
    {
        $status = array();
        if($this->complete_status == 0) {
            $status = ['state' => 'warning', 'title' => 'Draft'];
        }

        return $status;

    }

}
