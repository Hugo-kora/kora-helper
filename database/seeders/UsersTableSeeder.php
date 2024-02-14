<?php

namespace Database\Seeders;

use App\Models\{
    Profile,
    Tenant,
    User
};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hugo Pascoal',
            'email' => 'hugo_pascoal_@hotmail.com',
            'password' => bcrypt('3TL_81B£#~-x(2%N'),
        ]);

    }

}
