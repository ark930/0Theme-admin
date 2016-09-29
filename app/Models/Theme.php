<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    //

    public function currentVersion()
    {
        return $this->belongsTo('App\Models\ThemeVersion');
    }

    public function versions()
    {
        return $this->hasMany('App\Models\ThemeVersion');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'theme_tags', 'theme_id', 'tag_id');
    }
}
