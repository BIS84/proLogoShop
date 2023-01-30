<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
	{
		$orderId = session('orderId');

		if (!is_null($orderId) && Order::getFullSum() > 0) { // Проверяем, что заказ существует и стоимость больше нуля
			return $next($request);
		}

		session()->flash('warning', 'Ваша корзина пуста');
		return to_route('index'); // Редиректит на главную страницу
	}
}
