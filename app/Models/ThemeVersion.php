<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeVersion extends Model
{
    /**
     * A template path for theme resources
     *
     * First %s: theme full name
     * Second %s: subdirectory
     * Third %s: file name
     */
    const THEME_RESOURCE_TEMPLATE_PATH = 'storage/theme/%s/%s/%s';

    const THUMBNAIL_DIRECTORY_NAME = 'thumbnail';
    const SHOWCASE_DIRECTORY_NAME = 'showcase';

    public function theme()
    {
        return $this->belongsTo('App\Models\Theme');
    }

    public function downloads()
    {
        return $this->hasMany('App\Models\ThemeDownload');
    }

    public function showcases()
    {
        return $this->hasMany('App\Models\ThemeVersionShowcase');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'theme_version_tags', 'theme_version_id', 'tag_id');
    }

    public function categoryTags()
    {
        $tags = $this->tags->where('type', 'theme_category')->all();

        $tagArray = [];
        foreach ($tags as $tag) {
            $tagArray[] = $tag['name'];
        }

        return $tagArray;
    }

    public function typeTags()
    {
        $tags = $this->tags->where('type', 'theme_type')->all();

        $tagArray = [];
        foreach ($tags as $tag) {
            $tagArray[] = $tag['name'];
        }

        return $tagArray;
    }

    public function categoryTagsString()
    {
        return $this->tags->where('type', 'theme_category')->implode('name', '/');
    }

    public function typeTagsString()
    {
        return $this->tags->where('type', 'theme_type')->implode('name', '/');
    }

    public function getThemeFullName()
    {
        return sprintf('%s-%s', $this->theme['name'], $this['version']);
    }

    public function getThumbnailUrl()
    {
        $path = sprintf(self::THEME_RESOURCE_TEMPLATE_PATH,
            $this->getThemeFullName(), self::THUMBNAIL_DIRECTORY_NAME, $this['thumbnail']);

        return url($path);
    }

    public function getThumbnailTinyUrl()
    {
        $path = sprintf(self::THEME_RESOURCE_TEMPLATE_PATH,
            $this->getThemeFullName(), self::THUMBNAIL_DIRECTORY_NAME, $this['thumbnail_tiny']);

        return url($path);
    }

    public function getShowcaseUrls()
    {
        $data = [];
        foreach ($this->showcases as $item) {
            $path = sprintf(self::THEME_RESOURCE_TEMPLATE_PATH,
                $this->getThemeFullName(), self::SHOWCASE_DIRECTORY_NAME, $item['name']);
            $data[] = [
                'title' => $item['title'],
                'url' => url($path),
            ];
        }

        return $data;
    }
}
