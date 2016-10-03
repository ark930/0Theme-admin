<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderInfo(OrderRepository $orderRepository)
    {
        $orderInfo = $orderRepository->orderInfo();

        return [
            'data' => $orderInfo,
        ];
    }
}
