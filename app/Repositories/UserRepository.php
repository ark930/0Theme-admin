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
            ->whereNotNull('register_at')
            ->groupBy('membership')
            ->get();

        $ret = [];
        foreach ($data as $item) {
            $ret[$item->membership] = $item->total;
        }

        if(!isset($ret['free'])) {
            $ret['free'] = 0;
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
            ->where('register_at', '>=', Datetime::today())
            ->where('register_at', '<', Datetime::tomorrow())
            ->count();
    }

    private function getThisMonthRegisteredUserCount()
    {
        return $this->user
            ->where('register_at', '>=', Datetime::thisMonth())
            ->where('register_at', '<', Datetime::nextMonth())
            ->count();
    }

    private function getThisYearRegisteredUserCount()
    {
        return $this->user
            ->where('register_at', '>=', Datetime::thisYear())
            ->where('register_at', '<', Datetime::nextYear())
            ->count();
    }

    private function getTotalRegisteredUserCount()
    {
        return $this->user
            ->whereNotNull('register_at')
            ->count();
    }

}