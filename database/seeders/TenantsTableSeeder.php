<?php

namespace Database\Seeders;

use App\Models\{
    Plan,
    Tenant,
};
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{

    public function run()
    {

        Tenant::create([
            'name' => 'Los Korvos - Complexo',
            'url' => 'los_korvos_complexo',
            'active' =>  true
        ]);


        Tenant::create([
            'name' => 'Los Korvos - Capital',
            'url' => 'los_korvos_capital',
            'active' =>  true
        ]);
    }
}
