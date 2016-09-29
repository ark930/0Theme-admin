<?php

namespace App\Repositories;

use App\Models\Theme;
use Illuminate\Support\Facades\DB;

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

    public function themeDownloadInfo()
    {
        $themeDownloadInfo = DB::table('themes')
            ->join('theme_versions', 'themes.id', '=', 'theme_versions.theme_id')
            ->join('theme_downloads', 'theme_versions.id', '=', 'theme_downloads.theme_version_id')
            ->select('themes.id', 'themes.name', DB::raw('count(*) as total'))
            ->groupBy('themes.id')
            ->get();

        return $themeDownloadInfo;
    }
}