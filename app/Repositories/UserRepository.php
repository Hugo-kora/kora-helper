<?php

namespace App\Repositories;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserRepository{

    public function __construct(protected User $user)
    {

    }

    public function createUser(array $data, array $profileIds)
    {
        // Gere uma senha temporária aleatória
        $temporaryPassword = Str::random(10); // Gera uma senha temporária de 10 caracteres

        // Crie o usuário no banco de dados
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($temporaryPassword),
            'must_change_password' => true,
            'temporary_password' => $temporaryPassword,
        ]);

        // Associar o usuário com os perfis
        $user->profiles()->attach($profileIds);

        return $user;
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function hasPermissions(User $user, string $permissionName): bool
    {
        if ($user->isSuperAdmin()) {

            return true;
        }

        $profileIds = $user->profiles->pluck('id')->toArray();

        return Permission::whereHas('profiles', function ($query) use ($profileIds) {
            $query->whereIn('id', $profileIds);
        })->where('name', $permissionName)->exists();
    }


}
