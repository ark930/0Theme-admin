<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\ThemeRepository;
use App\Repositories\ThemeUploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function newTheme()
    {
        return view('new_theme');
    }

    public function updateTheme()
    {
        return view('new_theme');
    }

    public function newThemeUpload()
    {
        return '';
    }

    public function upgradeThemeUpload(Request $request, $theme_id, ThemeUploadRepository $themeUploadRepo)
    {
        $uploadPath = 'theme_upload';

        // todo check the file size
        $package = $request->file('package');
        $this->validate($request, [
            'package' => 'required|mimetypes:application/zip|max:50000',
        ]);

        $themeUploadRepo->clearThemeUploadDirectory();

        // store file in $uploadPath
        $filePath = $package->store($themeUploadRepo->getUploadPath());

        $themeUploadRepo->unzipThemeFile($filePath);

        // get the uploaded theme's directory name
        $themePath = Storage::directories($uploadPath)[0];

        // get config content
        $configPath = sprintf('%s/config.json', $themePath);
        $config = Storage::get($configPath);

        // get changelog content
        $changelogPath = sprintf('%s/changelog.txt', $themePath);
        $changelog = Storage::get($changelogPath);

        // get description content
        $descriptionPath = sprintf('%s/description/index.html', $themePath);
        $description = Storage::get($descriptionPath);

        Storage::delete($filePath);

        return redirect()->back()->with([
            'config' => json_decode($config, true),
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
