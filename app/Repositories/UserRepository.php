<?php

namespace App\Repositories;
use App\Models\Permission;
use App\Models\User;


class UserRepository{

    public function __construct(protected User $user)
    {
        
    }

    public function createUser(array $data)
    {
        $name = strtolower(str_replace(' ', '', $data['name']));

        $name = preg_replace('/[áàãâä]/ui', 'a', $name);
        $name = preg_replace('/[éèêë]/ui', 'e', $name);
        $name = preg_replace('/[íìîï]/ui', 'i', $name);
        $name = preg_replace('/[óòõôö]/ui', 'o', $name);
        $name = preg_replace('/[úùûü]/ui', 'u', $name);
        $name = preg_replace('/[ç]/ui', 'c', $name);

        $data['user_id'] = auth()->user();

        if (isset($data['foto'])) {
            $data['foto'] = $data['foto']->store('users');
        }

        $data['password'] = 'lk' . $name . '2023';
        $data['password'] = bcrypt($data['password']);

        return User::create($data);
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