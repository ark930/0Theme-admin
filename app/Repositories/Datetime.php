<?php

namespace App\Repositories;

class Datetime {
    public static function today()
    {
        return date('Y-m-d 00:00:00');
    }

    public static function tomorrow()
    {
        return date('Y-m-d 00:00:00', strtotime("+1 day"));
    }

    public static function thisMonth()
    {
        return date('Y-m-1 00:00:00');
    }

    public static function nextMonth()
    {
        return date('Y-m-1 00:00:00', strtotime("+1 month"));
    }

    public static function thisYear()
    {
        return date('Y-1-1 00:00:00');
    }

    public static function nextYear()
    {
        return date('Y-1-1 00:00:00', strtotime("+1 year"));
    }
}