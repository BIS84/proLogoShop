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
	if (!is_null($orderId)) { // Проверяем, что заказ существует
		$order = Order::findOrFail($orderId); // findOrFail() выдаст 404, если по айдишнику ничего не найдено
		if ($order->products->count() == 0) { // Если количество товаров в корзине 0
		session()->flash('warning', 'Ваша корзина пуста');
		return to_route('index'); // Редиректит на главную страницу
		}
	}

        return $next($request);
    }
}
