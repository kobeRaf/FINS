<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{

    protected $table = 'cashadvances'; // 👈 important since no underscore

    protected $fillable = [
        'tracking_no',
        'disbursement_officer',
        'date_requested',
    ];

    public function payees()
    {
        return $this->hasMany(Payee::class);
    }
}
