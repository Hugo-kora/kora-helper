<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Administradores
        Permission::create(['name' => 'admin.index','description' => 'Acesso ao dashboard']);

        //usuários
        Permission::create(['name' => 'users.index', 'description' => 'Listar Usuários']);
        Permission::create(['name' => 'users.search', 'description' => 'Buscar Usuários']);
        Permission::create(['name' => 'users.create', 'description' => 'Acessar tela de criar Usuários']);
        Permission::create(['name' => 'users.enviar-convite', 'description' => 'Permissão para enviar convites']);
        Permission::create(['name' => 'users.show', 'description' => 'Visualizar Usuário']);
        Permission::create(['name' => 'users.update', 'description' => 'Atualizar Usuários']);
        Permission::create(['name' => 'users.destroy', 'description' => 'Deletar Usuários']);

        //profiles x users
        Permission::create(['name' => 'users.profiles', 'description' => 'Visualizar os perfis na tela de usuários']);
        Permission::create(['name' => 'users.profiles.available', 'description' => 'Visualizar os perfis disponíveis para o usuário']);
        Permission::create(['name' => 'users.syncProfiles', 'description' => 'Vincular os perfis com os usuários']);
        Permission::create(['name' => 'users.profile.detach', 'description' => 'Remover vinculação de usuários com perfis']);

        //profiles
        Permission::create(['name' => 'profiles.index', 'description' => 'Listar Perfis']);
        Permission::create(['name' => 'profiles.search', 'description' => 'Buscar Perfis']);
        Permission::create(['name' => 'profiles.create', 'description' => 'Acessar tela de criar Perfis']);
        Permission::create(['name' => 'profiles.store', 'description' => 'Criar Perfis']);
        Permission::create(['name' => 'profiles.show', 'description' => 'Visualizar Perfil']);
        Permission::create(['name' => 'profiles.edit', 'description' => 'Acessar tela de editar Perfis']);
        Permission::create(['name' => 'profiles.update', 'description' => 'Atualizar Perfis']);
        Permission::create(['name' => 'profiles.permissions', 'description' => 'Visualizar as permissões nos perfis']);
        Permission::create(['name' => 'profiles.syncPermissions', 'description' => 'Vincular permissões aos perfis']);
        Permission::create(['name' => 'profiles.permission.detach', 'description' => 'Remover vinculo entre permissões aos perfis']);

    }
}
