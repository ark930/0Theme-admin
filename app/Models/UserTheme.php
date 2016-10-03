<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTheme extends Model
{
    public function activateSites()
    {
        return $this->hasMany('App\Models\UserThemeSite', 'theme_key');
    }
}
