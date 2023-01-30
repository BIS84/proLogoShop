<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('basket', ['order' => $order]);
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
		if (is_null($orderId)) {
			return redirect()->route('index'); // Если заказа нет, переходим на главную
		}

		$order = Order::find($orderId);
		return view('order', ['order' => $order]);
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if($order->products->contains($productId)) { // Проверяем есть ли такой товар в корзине
            $pivotRow = $order->products()
                        ->where('product_id', $productId)
                        ->first()
                        ->pivot; // Получаем доступ к полям таблицы (для данного товара)
            $pivotRow->count++; // Увеличиваем счетчик
            $pivotRow->update(); // Обновляем поля
        } else {
            $order->products()->attach($productId); // Если товара еще не было в корзине, добавляем
        }

        if (Auth::check()) { // Если авторизован
            $order->user_id = Auth::id(); // В заказе указываем id пользователя
            $order->save();
        }

        $product = Product::find($productId);

        Order::changeFullSum($product->price);

        session()->flash('success', 'Добавлен товар '.$product->name);

        return to_route('basket');
    }

    public function basketRemove($productId)
	{
		$orderId = session('orderId');

		if(is_null($orderId)) {
			return to_route('index');
		}

        $order = Order::find($orderId);

		if($order->products->contains($productId)) { // Проверяем есть ли такой товар в корзине
            $pivotRow = $order->products()
                        ->where('product_id', $productId)
                        ->first()
                        ->pivot; // Получаем доступ к полям таблицы (для данного товара)
            if($pivotRow->count < 2) {
                $order->products()->detach($productId); // Если такой товар в корзине один, удаляем его
            } else {
                $pivotRow->count--; // Уменьшаем счетчик

            }
            $pivotRow->update(); // Обновляем поля
        }

        $product = Product::find($productId);

        Order::changeFullSum(-$product->price);

        session()->flash('warning', 'Удален товар '.$product->name);

		return to_route('basket');
	}

    public function basketConfirm(Request $request)
	{
        $orderId = session('orderId');
        if (is_null($orderId)) {
		    return to_route('index'); // Если заказа нет, переходим на главную
        }

        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!'); // Во flash передаем ключ и сообщение.
        } else {
            session()->flash('warning', 'Произошла ошибка');
        }

        Order::eraseOrderSum();

        return to_route('index');
	}
}
