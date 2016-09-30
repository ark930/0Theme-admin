<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\ThemeRepository;
use App\Repositories\UserRepository;

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

    public function upgradeThemeUpload()
    {
        return '';
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
