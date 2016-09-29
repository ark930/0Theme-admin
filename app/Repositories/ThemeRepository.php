<?php

namespace App\Repositories;

use App\Models\Theme;

class ThemeRepository {

    protected $model;

    public function __construct(Theme $model)
    {
        $this->model = $model;
    }

    public function themeInfo()
    {
        $themes = $this->model->all();

        $ret = [];
        foreach ($themes as $theme) {
            $currentVersion = $theme->currentVersion;

            $ret[] = [
                'name' => $theme['name'],
                'category' => $theme->categoryTags(),
                'type' => $theme->typeTags(),
                'version' => $currentVersion['version'],
                'release_at' => $currentVersion['release_at'],
                'download_count' => $currentVersion->downloads()->count(),
            ];
        }

        return $ret;
    }
}