<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name', 'author',
    ];

    public function currentVersion()
    {
        return $this->belongsTo('App\Models\ThemeVersion', 'current_version_id');
    }

    public function versions()
    {
        return $this->hasMany('App\Models\ThemeVersion');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_themes', 'user_id', 'theme_id')
            ->withPivot('activate_at', 'expire_at', 'theme_key', 'is_activate', 'deactivate_reason')
            ->withTimestamps();
    }

    public function categoryTags()
    {
        return $this->currentVersion->tags->where('type', 'theme_category')->implode('name', '/');
    }

    public function typeTags()
    {
        return $this->currentVersion->tags->where('type', 'theme_type')->implode('name', '/');
    }

    public function tagsCount()
    {
        $tags = $this->tags;

        $typeCount = $tags->where('type', 'theme_type')->count();
        $categoryCount = $tags->where('category', 'theme_category')->count();

        return [
            'type' => $typeCount,
            'category' => $categoryCount,
        ];
    }
}
