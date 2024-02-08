<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Gerentes
       //Profile::create(['name' => 'Administrador','description' => 'Perfil do Administrador']);
        Profile::create(['name' => 'Gerente','description' => 'Perfil do Gerente']);
        
        
    }
}
