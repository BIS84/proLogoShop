<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = ['user_id'];

    public function products()
	{
		return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
	}

    public function calculateFullSum()
	{
		$sum = 0;
		foreach ($this->products()->withTrashed()->get() as $product) {
			$sum += $product->getPriceForCount();
		}

		return $sum;
	}

    public static function eraseOrderSum()
	{
		session()->forget('full_order_sum'); // forget - забыть эту переменную, т.е удалить ее из сессии
	}

	public static function changeFullSum($changeSum)
	{

		$sum = self::getFullSum() + $changeSum;
		session(['full_order_sum' => $sum]);
	}

    public static function getFullSum()
	{
		return session('full_order_sum', 0); // Получаем цену заказа из сессии
	}

    public function saveOrder($name, $phone) // С реквестом здесь не можем работать. Поэтому передаем сюда переменные.
	{
		if ($this->status == 0) {
			$this->name = $name;
			$this->phone = $phone;
			$this->status = 1;
			$this->save();
			session()->forget('orderId');
			return true;
		} else {
			return false;
		}
	}

    public function scopeActive($query)
	{
		return $query->where('status', 1);
	}
}
