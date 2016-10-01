<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\User;
use App\Repositories\ThemeRepository;
use App\Repositories\ThemeUploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(UserRepository $userRepository, ThemeRepository $themeRepository)
    {
        $userMembership = $userRepository->userMembershipData();
        $userGrowth = $userRepository->userGrowthData();
        $themeDownloadInfo = $themeRepository->themeDownloadInfo();

        return view('dashboard', [
            'userMembership' => $userMembership,
            'userGrowth' => $userGrowth,
            'themeDownloadInfo' => $themeDownloadInfo,
        ]);
    }

    public function themes(ThemeRepository $themeRepository)
    {
        $themeInfo = $themeRepository->themeInfo();

        return view('themes', [
            'themeInfo' => $themeInfo
        ]);
    }

    public function users()
    {
        return view('users');
    }

    public function finance()
    {
        return view('finance');
    }

    public function settings()
    {
        return view('settings');
    }

    public function userDetails($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('user_details', [
            'user' => $user,
        ]);
    }

    public function newOrUpgradeTheme($theme_id = null)
    {
        $theme = null;
        if(!is_null($theme_id)) {
            $theme = Theme::findOrFail($theme_id);
        }

        return view('new_theme', [
            'theme' => $theme,
        ]);
    }

    public function newOrUpgradeThemeUpload(Request $request, ThemeUploadRepository $themeUploadRepo, $theme_id = null)
    {
        $theme = null;
        if(!is_null($theme_id)) {
            $theme = Theme::findOrFail($theme_id);
        }

        $package = $request->file('package');
        $this->validate($request, [
            'package' => 'required|mimetypes:application/zip|max:50000',
        ]);

        $themeUploadRepo->clearThemeUploadDirectory();

        // store file in $uploadPath
        $filePath = $package->store($themeUploadRepo->getUploadPath());

        // unzip theme file
        $themeUploadRepo->unzipThemeFile($filePath);

        // validate theme files' structure
        if($themeUploadRepo->validateThemeStructure() === false) {
            $themeUploadRepo->clearThemeUploadDirectory();
            return redirect()->back()->withErrors("This theme's structure is illegal");
        }

        // get data from theme path
        $config = $themeUploadRepo->getConfigContent();
        $changelog = $themeUploadRepo->getChangelogContent();
        $description = $themeUploadRepo->getDescriptionContent();

        // validate theme files' content
        if($themeUploadRepo->validateThemeContent() === false) {
            $themeUploadRepo->clearThemeUploadDirectory();
            return redirect()->back()->withErrors("This theme's content is illegal");
        }

        $themeUploadRepo->moveFiles();
        $themeUploadRepo->clearThemeUploadDirectory();

        // save data to database
        $theme = $themeUploadRepo->saveData($theme);

        $redirectTo = sprintf('/theme/new/%s', $theme['id']);
        return redirect($redirectTo)->with([
            'config' => $config,
            'changelog' => $changelog,
            'description' => $description,
        ]);
    }

    /**
     * Uses info for users page
     *
     * @param UserRepository $userRepository
     *
     * @return array
     */
    public function userInfo(UserRepository $userRepository)
    {
        $userInfo = $userRepository->userInfo();

        return [
            'data' => $userInfo,
        ];
    }
}
