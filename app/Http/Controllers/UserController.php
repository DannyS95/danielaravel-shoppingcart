<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function userProfile()
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders' => $orders]);
    }
}
