<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'iPhone X 64GB',
                'code' => 'iphone_x_64',
                'description' => 'Отличный продвинутый телефон',
                'image' => '',
                'price' => 71990,
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone X 256GB',
                'code' => 'iphone_x_256',
                'description' => 'Отличный продвинутый телефон',
                'image' => '',
                'price' => 89990,
            ],
            [
                'category_id' => 1,
                'name' => 'HTC One S',
                'code' => 'htc_one_s',
                'description' => 'Зачем платить за лишнее?',
                'image' => '',
                'price' => 12490,
            ],
            [
                'category_id' => 1,
                'name' => 'iPhone 5SE',
                'code' => 'iphone_5se',
                'description' => 'Отличный классический iPhone',
                'image' => '',
                'price' => 17221,
            ],
            [
                'category_id' => 2,
                'name' => 'Наушники Beats Audio',
                'code' => 'beats_audio',
                'description' => 'Отличный звук',
                'image' => '',
                'price' => 20221,
            ],
            [
                'category_id' => 2,
                'name' => 'Камера GoPro',
                'code' => 'gopro',
                'description' => 'Снимай самые яркие моменты',
                'image' => '',
                'price' => 12000,
            ],
            [
                'category_id' => 2,
                'name' => 'Камера Panasonic HC-V770',
                'code' => 'panasonic_hc-v770',
                'description' => 'Для серьезной видеосъемки',
                'image' => '',
                'price' => 27900,
            ],
            [
                'category_id' => 3,
                'name' => 'Кофемашина DeLongi',
                'code' => 'delongi',
                'description' => 'Хорошее утро начинается с хорошего кофе',
                'image' => '',
                'price' => 71990,
            ],
            [
                'category_id' => 3,
                'name' => 'Холодильник Haier',
                'code' => 'haier',
                'description' => 'Для большой семьи большой холодильник',
                'image' => '',
                'price' => 40200,
            ],
            [
                'category_id' => 3,
                'name' => 'Блендер Moulinex',
                'code' => 'moulinex',
                'description' => 'Для самых смелых людей',
                'image' => '',
                'price' => 4200,
            ],
            [
                'category_id' => 3,
                'name' => 'Мясорубка Bosch',
                'code' => 'bosch',
                'description' => 'Любите домашние котлеты? Вам нужна эта мясорубка',
                'image' => '',
                'price' => 9200,
            ],
        ]);
    }
}
