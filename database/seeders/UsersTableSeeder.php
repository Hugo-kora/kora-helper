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
            'password' => bcrypt('123456'),
        ]);

        $user = User::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
            ]);

            $adminProfile = Profile::firstOrCreate(['name' => 'Administrador','description' => 'Perfil do Administrador']);

            if ($adminProfile) {
                $user->profiles()->sync([$adminProfile->id]);
        }

    }

    }

