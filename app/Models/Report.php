<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "report_template";
       protected $fillable = [
        'header_logo_1a',
        'header_logo_1b',
        'header_logo_1c',
        'header_logo_1d',
        'report_title',
        'report_subtitle',
        'footer_logo_2a',
        'footer_logo_2b',
        'footer_logo_2c',
        'footer_logo_2d',
        'footer_title',
    ];
}
