<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //creando roles
         $role1 = Role::create(['name' =>'Administrador']);
         $role2 = Role::create(['name' =>'Desarrollador']);
         $role3 = Role::create(['name' =>'Caja']);
         $role4 = Role::create(['name' => 'Sin Rol']);

          //creando permisos y relacionandolos con los roles
          Permission::create(['name' => 'administrador'])->syncRoles([$role1, $role2]);
          Permission::create(['name'=> 'procesos.diarios'])->syncRoles([$role1,$role2, $role3]);

                  //permisos para editar y eliminar productos
         Permission::create(['name' => 'editarProductos'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'eliminarProductos'])->syncRoles([$role1, $role2]);

          //permisos para editar y eliminar tasa de cambio
          Permission::create(['name' => 'editarTasa'])->syncRoles([$role1, $role2]);
          Permission::create(['name' => 'eliminarTasa'])->syncRoles([$role1, $role2]);

          //creando usuario
         User::create(
            [
                'name' => 'Hamilton Rivera',
                'email' => 'rivera.hamilton21@gmail.com',
                'password' =>bcrypt('admin')
            ]
        )->assignRole('Desarrollador');


        User::create(
            [
                'name' => 'German',
                'email' => 'germandelgadillo35@gmail.com',
                'password' =>bcrypt('admin')
            ]
        )->assignRole('Desarrollador');

        User::create(
            [
                'name' => 'Gorge',
                'email' => 'glmolinares@gmail.com',
                'password' =>bcrypt('admin')
            ]
        )->assignRole('Desarrollador');
        
        User::create(
            [
                'name' => 'Josj',
                'email' => 'jaltomisraunoe211003@gmail.com',
                'password' =>bcrypt('admin')
            ]
        )->assignRole('Desarrollador');
    }
}
