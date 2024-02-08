<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // //Administradores
        // Category::create(['name' => 'TI','url' => 'ti','anchor_url' => 'http://korasaude.com.br','image' => 'categories/SNTkrtEhRXkY2B2Y7s2zeEnBnCWd7h1wgiO7flOs.svg', 'color_card' => '#a2c9e1', 'color_icon' => '#a2c9e1']);

    }
}
