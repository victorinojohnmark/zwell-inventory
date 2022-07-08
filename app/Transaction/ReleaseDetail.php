<?php

namespace App\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Transaction\Release;
use App\Master\Item;

class ReleaseDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbt_release_details';

    protected $fillable = [
    'release_id', 
    'item_id', 
    'quantity', 
    ];

    public $validationrules = [
    'release_id' => 'required|integer', 
    'item_id' => 'required|integer', 
    'quantity' => 'required|numeric|gt:0', 
    ];

    public $validationmessages = [ 
        'item_id.required' => 'Item is required',
        'item_id.integer' => 'Item is required',

        'quantity.required' => 'Quantity is required',
        'quantity.gt' => 'Quantity needs to be greater than zero',
    ];

    public static function createRecord($values): self
    {
        return self::create([
            'release_id' => $values['release_id'], 
            'item_id' => $values['item_id'], 
            'quantity' => $values['quantity'], 
        ]);
    }

    public function release()
    {
        return $this->belongsTo(Release::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
