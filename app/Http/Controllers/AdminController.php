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

        if(is_null($theme)) {
            return view('new_theme');
        }

        return view('new_theme', [
            'theme' => $theme,
            'themeVersion' => $theme->currentVersion,
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

        // validate theme files' content
        if($themeUploadRepo->validateThemeContent($theme) === false) {
            $themeUploadRepo->clearThemeUploadDirectory();
            return redirect()->back()->withErrors("This theme's content is illegal");
        }

        $themeUploadRepo->moveFiles();
        $themeUploadRepo->clearThemeUploadDirectory();

        // save data to database
        $data = $themeUploadRepo->saveData($theme);
        $data['new'] = true;

        $redirectTo = route('upload_theme_page', ['theme_id' => $data['theme']['id']]);
        return redirect($redirectTo)->with($data);
    }

    public function themeVersionPublish($theme_id, $theme_version_id)
    {
        $theme = Theme::findOrFail($theme_id);
        $themeVersion = $theme->versions->where('id', $theme_version_id)->first();
        if(empty($themeVersion)) {
            return abort(404);
        }
        $theme->currentVersion()->associate($themeVersion);
        $theme->save();

        return redirect()->back();
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
