<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 1)->get();
		return view('auth.orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
	{
		return view('auth.orders.show', ['order' => $order]);
	}
}
