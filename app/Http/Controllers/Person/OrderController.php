<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
	{
		$orders =Auth::user()->orders()->where('status', 1)->get();
		return view('auth.orders.index', ['orders' => $orders]);
	}

	public function show($id)
	{
		$order =Order::where('id', $id)->first();
		if(!Auth::user()->orders->contains($order)) {
			return back();
		}
		return view('auth.orders.show', ['order' => $order]);
	}
}
