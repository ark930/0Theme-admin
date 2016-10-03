<?php
/**
 * Created by PhpStorm.
 * User: edwin
 * Date: 2016/10/3
 * Time: 下午5:19
 */

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository {
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function orderInfo()
    {
        $orders = $this->model->all();

        $ret = [];
        foreach ($orders as $order) {
            $user = $order->user;

            $ret[] = [
                $user['name'],
                $user['membership'],
                $user['email'],
                $order['order_no'],
                'date',
                $order['paid_amount'],
                $order['status'],
                'refund'
            ];
        }

        return $ret;
    }

    public function earningData()
    {
        return [
            'today' => $this->getTodayEarning(),
            'month' => $this->getThisMonthEarning(),
            'year' => $this->getThisYearEarning(),
            'total' => $this->getTotalEarning(),
        ];
    }

    private function getTodayEarning()
    {
        $data = DB::table('orders')
            ->select(DB::raw('count(pay_amount) as amount'))
            ->where('created_at', '>=', Datetime::today())
            ->where('created_at', '<', Datetime::tomorrow())
            ->where('status', 'paid')
            ->first();

        return $data->amount;
    }

    private function getThisMonthEarning()
    {
        $data = DB::table('orders')
            ->select(DB::raw('count(pay_amount) as amount'))
            ->where('created_at', '>=', Datetime::thisMonth())
            ->where('created_at', '<', Datetime::nextMonth())
            ->where('status', 'paid')
            ->first();

        return $data->amount;
    }

    private function getThisYearEarning()
    {
        $data = DB::table('orders')
            ->select(DB::raw('count(pay_amount) as amount'))
            ->where('created_at', '>=', Datetime::thisYear())
            ->where('created_at', '<', Datetime::nextYear())
            ->where('status', 'paid')
            ->first();

        return $data->amount;
    }

    private function getTotalEarning()
    {
        $data = DB::table('orders')
                  ->select(DB::raw('count(pay_amount) as amount'))
                  ->where('status', 'paid')
                  ->first();

        return $data->amount;
    }

}