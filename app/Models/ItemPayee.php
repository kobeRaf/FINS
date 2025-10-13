<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPayee extends Model
{

    protected $table = 'item_payees';
    
    protected $fillable = [
        'payee_id',
        'amount',
        'status',
        'date',
    ];

    /**
     * Each item belongs to a payee.
     */
    public function payee()
    {
        return $this->belongsTo(Payee::class);
    }
}
