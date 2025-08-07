<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    protected $table = "fund";
    
    protected $fillable = ['type' , 'fund_type', 'fund_title'];
}
