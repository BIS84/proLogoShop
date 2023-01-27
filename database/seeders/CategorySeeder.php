<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Мобильные телефоны',
                'code' => 'mobiles',
                'description' => 'Это категория, в которой находятся мобильные телефоны',
            ],
            [
                'name' => 'Портативная техника',
                'code' => 'portable',
                'description' => 'Это категория, в которой находится портативная техника',
            ],
            [
                'name' => 'Бытовая техника',
                'code' => 'appliances',
                'description' => 'Это категория, в которой находится бытовая техника',
            ],
        ]);
    }
}
