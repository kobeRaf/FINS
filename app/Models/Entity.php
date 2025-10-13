<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = "entity";
    
    protected $fillable = [
        'reference_no',
        'entity_name',
        'entity_type',
        'entity_address'
    ];
}
