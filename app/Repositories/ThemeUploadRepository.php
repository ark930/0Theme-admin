<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Theme;
use App\Models\ThemeVersion;
use App\MOdels\ThemeVersionShowcase;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Storage;

class ThemeUploadRepository {
    /**
     * A path for uploading theme files under storage/app
     *
     * @var string
     */
    private $uploadPath = 'theme_upload';

    /**
     * A path for theme file
     *
     * @var string
     */
    private $themeTargetPath = 'theme';

    /**
     * A path for theme resources
     * for example:
     *      thumbnails, showcases and descriptions
     *
     * @var string
     */
    private $themeResourcePath = 'public/theme';

    /**
     *  A path for the theme which uploaded and extracted
     *
     * @var null
     */
    private $themeExtractedPath = null;

    private $themeFileName = null;
    private $zipThemeFileName = null;

    private $themePath = null;
    private $configPath = null;
    private $changelogPath = null;
    private $descriptionIndexPath = null;
    private $thumbnailPath = null;
    private $thumbnailTinyPath = null;

    private $config = null;
    private $changelog = null;
    private $description = null;

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
            Storage::delete($file);
        }
    }

    /**
     * Extract zip file to $uploadPath
     *
     * @param $unzipFilePath
     */
    public function unzipThemeFile($unzipFilePath)
    {
        $zipper = new Zipper();
        $zipFile = storage_path(sprintf('app/%s', $unzipFilePath));
        $unzipDir = storage_path(sprintf('app/%s', $this->getUploadPath()));
        $zipper->make($zipFile)->extractTo($unzipDir, ['__MACOSX'], Zipper::BLACKLIST);

        $this->themeExtractedPath = Storage::directories($this->uploadPath)[0];
        $this->configPath = sprintf('%s/config.json', $this->themeExtractedPath);
        $this->changelogPath = sprintf('%s/changelog.txt', $this->themeExtractedPath);
        $this->descriptionIndexPath = sprintf('%s/description/index.html', $this->themeExtractedPath);
    }

    /**
     * Get config content from config.json and convert it to array
     *
     * @return mixed
     */
    public function getConfigContent()
    {
        $this->config = Storage::get($this->configPath);

        $this->config = json_decode($this->config, true);

        foreach ($this->config as $k => &$v) {
            if(is_string($v)) {
                $v = trim($v);
            }
        }

        return $this->config;
    }

    /**
     * Get changelog content from changelog.txt
     *
     * @return mixed
     */
    public function getChangelogContent()
    {
        $this->changelog = Storage::get($this->changelogPath);

        return $this->changelog;
    }

    /**
     * Get description content from description/index.html
     *
     * @return mixed
     */
    public function getDescriptionContent()
    {
        $this->description = Storage::get($this->descriptionIndexPath);

        return $this->description;
    }

    /**
     * Validate theme structure
     *
     * @return bool
     */
    public function validateThemeStructure()
    {
        if(Storage::exists($this->configPath) == false) {
            return false;
        } else if(Storage::exists($this->changelogPath) == false) {
            return false;
        } else if(Storage::exists($this->descriptionIndexPath) == false) {
            return false;
        }

        return true;
    }

    /**
     * Validate theme content
     *
     * @param null $theme
     *
     * @return bool
     */
    public function validateThemeContent($theme = null)
    {
        // get data from theme path
        $this->getConfigContent();
        $this->getChangelogContent();
        $this->getDescriptionContent();

        if(!is_array($this->config) || empty($this->config)) {
            return false;
        }

        foreach ($this->config as $k => $v) {
            if(is_array($v)) {
                continue;
            } else if ($k == 'free_url' && $this->config['has_free'] == false) {
                continue;
            } else if (empty($v)) {
                return false;
            }
        }

        $themeName = $this->config['name'];
        $version = $this->config['version'];
        $sha1 = $this->config['sha1'];
        $thumbnail = $this->config['thumbnail'];
        $thumbnailTiny = $this->config['thumbnail_tiny'];
        $categories = $this->config['categories'];
        $types = $this->config['types'];
        $showcases = $this->config['showcases'];

        if(!is_null($theme)) {
            if($themeName != $theme['name']) {
                return false;
            }
        }

        $this->themeFileName = sprintf('%s-%s', $themeName, $version);
        $this->zipThemeFileName = sprintf('%s.zip', $this->themeFileName);
        $this->themePath = sprintf('%s/%s', $this->themeExtractedPath, $this->zipThemeFileName);
        $this->thumbnailPath = sprintf('%s/thumbnail/%s', $this->themeExtractedPath, $thumbnail);
        $this->thumbnailTinyPath = sprintf('%s/thumbnail/%s', $this->themeExtractedPath, $thumbnailTiny);

        if(Storage::exists($this->themePath) == false) {
            return false;
        }

        $sha1FromLocal = sha1(Storage::get($this->themePath));
        if($sha1FromLocal !== $sha1) {
            return false;
        }

        if(Storage::exists($this->thumbnailPath) == false) {
            return false;
        }

        if(Storage::exists($this->thumbnailTinyPath) == false) {
            return false;
        }

        if(!is_array($categories) || !is_array($types) || !is_array($showcases)) {
            return false;
        }

        foreach ($showcases as $item) {
            $showcasePath = sprintf('%s/showcase/%s', $this->themeExtractedPath, $item['name']);
            if(Storage::exists($showcasePath) == false) {
                return false;
            }
        }

        return true;
    }

    public function moveFiles()
    {
        // remove config.json and changelog.txt and description's index.html
        Storage::delete($this->configPath);
        Storage::delete($this->changelogPath);
        Storage::delete($this->descriptionIndexPath);

        // move theme zip file to target path
        $fromPath = $this->themePath;
        $toPath = sprintf('%s/%s', $this->themeTargetPath, $this->zipThemeFileName);
        if(Storage::exists($toPath)) {
            Storage::delete($toPath);
        }
        Storage::move($fromPath, $toPath);

        // move theme resource directory to public path
        $fromPath = $this->themeExtractedPath;
        $toPath = sprintf('%s/%s', $this->themeResourcePath, $this->themeFileName);
        if(Storage::exists($toPath)) {
            Storage::deleteDirectory($toPath);
        }
        Storage::move($fromPath, $toPath);
    }

    /**
     * Save data to database
     *
     * if $theme is null, a new theme will be saved,
     * otherwise refresh the theme data
     *
     * @param null $theme
     *
     * @return array
     */
    public function saveData($theme = null)
    {
        $themeVersion = null;

        if(is_null($theme)) {
            $theme = new Theme();
            $themeVersion = new ThemeVersion();
        } else {
            $themeVersion = $theme->versions()->where('version', $this->config['version'])->first();
            if(empty($themeVersion)) {
                $themeVersion = new ThemeVersion();
            }
        }

        $theme['name'] = $this->config['name'];
        $theme->save();

        $themeVersion['sha1'] = $this->config['sha1'];
        $themeVersion['version'] = $this->config['version'];
        $themeVersion['requirements'] = $this->config['requirements'];
        $themeVersion['document_url'] = $this->config['document_url'];
        $themeVersion['has_free'] = $this->config['has_free'];
        $themeVersion['free_url'] = $this->config['free_url'];
        $themeVersion['description'] = $this->config['description'];
        $themeVersion['changelog'] = $this->changelog;
        $themeVersion['thumbnail'] = $this->config['thumbnail'];
        $themeVersion['thumbnail_tiny'] = $this->config['thumbnail_tiny'];
        $themeVersion['release_at'] = date('Y-m-d H:i:s');
        $themeVersion['store_at'] = sprintf('%s/%s', $this->themeTargetPath, $this->zipThemeFileName);
        $themeVersion['store_type'] = 'local';
        $theme->versions()->save($themeVersion);

        $tags = [];
        foreach ($this->config['categories'] as $category) {
            $tag = new Tag();
            $tag['name'] = $category;
            $tag['type'] = 'theme_category';
            $tags[] = $tag;
        }
        foreach ($this->config['types'] as $type) {
            $tag = new Tag();
            $tag['name'] = $type;
            $tag['type'] = 'theme_type';
            $tags[] = $tag;
        }

        // detach old tags to the theme version then attach the new tags
        $oldTags = $themeVersion->tags;
        $themeVersion->tags()->detach();
        foreach ($oldTags as $oldTag) {
            $oldTag->delete();
        }
        $themeVersion->tags()->saveMany($tags);

        $themeVersionShowcases = [];
        foreach ($this->config['showcases'] as $showcase) {
            $themeVersionShowcase = new ThemeVersionShowcase();
            $themeVersionShowcase['name'] = $showcase['name'];
            $themeVersionShowcase['title'] = $showcase['title'];
            $themeVersionShowcases[] = $themeVersionShowcase;
        }

        // delete the old showcases and save the new showcases
        $oldShowcases = $themeVersion->showcases;
        foreach ($oldShowcases as $oldShowcase) {
            $oldShowcase->delete();
        }
        $themeVersion->showcases()->saveMany($themeVersionShowcases);

        return [
            'theme' => $theme,
            'theme_version' => $themeVersion,
        ];
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

}