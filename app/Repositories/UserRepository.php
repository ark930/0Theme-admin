<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function userMembershipData()
    {
        $data = DB::table('users')
            ->select('membership', DB::raw('count(*) as total'))
            ->where('registered', 1)
            ->groupBy('membership')
            ->get();

        $ret = [];
        foreach ($data as $item) {
            $ret[$item->membership] = $item->total;
        }

        if(!isset($ret['basic'])) {
            $ret['basic'] = 0;
        }

        if(!isset($ret['pro'])) {
            $ret['pro'] = 0;
        }

        if(!isset($ret['lifetime'])) {
            $ret['lifetime'] = 0;
        }

        return $ret;
    }

    public function userGrowthData()
    {
        return [
            'today' => $this->getTodayRegisteredUserCount(),
            'month' => $this->getThisMonthRegisteredUserCount(),
            'year' => $this->getThisYearRegisteredUserCount(),
            'total' => $this->getTotalRegisteredUserCount(),
        ];
    }

    public function userInfo()
    {
        $users = $this->user->all();

        $ret = [];
        foreach ($users as $user) {
            $ret[] = [
                $user['name'],
                $user['email'],
                $user['membership'],
                $user['register_at'],
                1,
                $user['id'],
            ];
        }

        return $ret;
    }

    private function getTodayRegisteredUserCount()
    {
        return $this->user
            ->where('registered', 1)
            ->where('register_at', '>=', $this->today())
            ->where('register_at', '<', $this->tomorrow())
            ->count();
    }

    private function getThisMonthRegisteredUserCount()
    {
        return $this->user
            ->where('registered', 1)
            ->where('register_at', '>=', $this->thisMonth())
            ->where('register_at', '<', $this->nextMonth())
            ->count();
    }

    private function getThisYearRegisteredUserCount()
    {
        return $this->user
            ->where('registered', 1)
            ->where('register_at', '>=', $this->thisYear())
            ->where('register_at', '<', $this->nextYear())
            ->count();
    }

    private function getTotalRegisteredUserCount()
    {
        return $this->user
            ->where('registered', 1)
            ->count();
    }

    private function today()
    {
        return date('Y-m-d 00:00:00');
    }

    private function tomorrow()
    {
        return date('Y-m-d 00:00:00', strtotime("+1 day"));
    }

    private function thisMonth()
    {
        return date('Y-m-1 00:00:00');
    }

    private function nextMonth()
    {
        return date('Y-m-1 00:00:00', strtotime("+1 month"));
    }

    private function thisYear()
    {
        return date('Y-1-1 00:00:00');
    }

    private function nextYear()
    {
        return date('Y-1-1 00:00:00', strtotime("+1 year"));
    }
}