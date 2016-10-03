<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaypalWebhooksController extends Controller
{
    public function index(Request $request)
    {
        Storage::put('public/webhooks/file.txt', json_encode($request->all()));

        return 'ok';
    }
}
