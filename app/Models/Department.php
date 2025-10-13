<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";

    protected $fillable = ['department_no', 'department_acronym', 'department_name' , 'department_head'];

}
