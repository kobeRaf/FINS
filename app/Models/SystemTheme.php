<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemTheme extends Model
{
        protected $table = 'system_theme';
        protected $fillable = ['logo', 'theme_color', 'bg_color', 'text_color', 'system_name', 'sub_system_name'];


}
