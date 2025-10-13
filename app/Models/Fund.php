<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table = "fund";

    protected $fillable = [
        'reference_no',
        'code',
        'fund_name',
        'fund_description'
    
    ];

    // // Automatically generate fund_no on create
    // protected static function booted()
    // {
    //     static::creating(function ($fund) {
    //         if (empty($fund->fund_no)) {
    //             $random = mt_rand(1000, 9999);
    //             $fund->fund_no = 'FUND_' . $random . now()->format('YmdHis');
    //         }
    //     });
    // }
}
