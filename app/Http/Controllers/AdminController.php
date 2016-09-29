<?php

namespace App\Http\Controllers;

use App\Repositories\ThemeRepository;
use App\Repositories\UserRepository;

class AdminController extends Controller
{
    public function dashboard(UserRepository $userRepository)
    {
        $userMembership = $userRepository->userMembershipData();
        $userGrowth = $userRepository->userGrowthData();

        return view('dashboard', [
            'userMembership' => $userMembership,
            'userGrowth' => $userGrowth,
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
