<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();

        return view('basket', ['order' => $order]);
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', 'Товар не доступен для заказа в полном объеме');
            return redirect()->route('basket');
		}

		return view('order', ['order' => $order]);
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);

        if ($result) {
            session()->flash('success', 'Добавлен товар '.$product->name);
        } else {
            session()->flash('warning', 'Произошла ошибка');
        }

        return to_route('basket');
    }

    public function basketRemove(Product $product)
	{
		(new Basket())->removeProduct($product);

        session()->flash('warning', 'Удален товар '.$product->name);

		return to_route('basket');
	}

    public function basketConfirm(Request $request)
	{
        if ((new Basket())->saveOrder($request->name, $request->phone)) {
            session()->flash('success', 'Ваш заказ принят в обработку!'); // Во flash передаем ключ и сообщение.
        } else {
            session()->flash('warning', 'Произошла ошибка');
        }

        Order::eraseOrderSum();

        return to_route('index');
	}
}
