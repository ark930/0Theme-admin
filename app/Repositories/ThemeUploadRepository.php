<?php

namespace App\Repositories;

use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Storage;

class ThemeUploadRepository {
    private $uploadPath = 'theme_upload';

    /**
     * Clear the theme directory include subdirectories and files
     */
    public function clearThemeUploadDirectory()
    {
        $tempDirs = Storage::directories($this->getUploadPath());
        foreach ($tempDirs as $dir) {
            Storage::deleteDirectory($dir);
        }

        $tempFiles = Storage::allFiles($this->getUploadPath());
        foreach ($tempFiles as $file) {
            var_dump($file);
            Storage::delete($file);
        }
    }

    /**
     * Extract zip file in $uploadPath
     *
     * @param $unzipFilePath
     */
    public function unzipThemeFile($unzipFilePath)
    {
        $zipper = new Zipper();
        $zipFile = storage_path(sprintf('app/%s', $unzipFilePath));
        $unzipDir = storage_path(sprintf('app/%s', $this->getUploadPath()));
        $zipper->make($zipFile)->extractTo($unzipDir, ['__MACOSX'], Zipper::BLACKLIST) ;
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

}