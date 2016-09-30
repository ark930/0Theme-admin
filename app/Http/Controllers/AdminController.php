<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\ThemeRepository;
use App\Repositories\UserRepository;
use Chumper\Zipper\Zipper;
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

    public function upgradeThemeUpload(Request $request, $theme_id)
    {
        $uploadPath = 'theme_upload';

        // todo check the file size
        $filePath = $request->file('package')->store($uploadPath);

        $zipper = new Zipper();
        $zipFile = storage_path(sprintf('app/%s', $filePath));
        $unzipDir = storage_path(sprintf('app/%s', $uploadPath));
        $zipper->make($zipFile)->extractTo($unzipDir, ['__MACOSX'], Zipper::BLACKLIST) ;

        $themePath = Storage::directories($uploadPath)[0];
        $configPath = sprintf('%s/config.json', $themePath);
        $changelogPath = sprintf('%s/changelog.txt', $themePath);
        $config = Storage::get($configPath);
        $changelog = Storage::get($changelogPath);

        Storage::delete($filePath);
        return redirect()->back()->with([
            'config' => json_decode($config, true),
            'changelog' => $changelog,
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
