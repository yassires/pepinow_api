<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // $addRole = 'add-role';
        // $editRole = 'edit-role';
        // $deleteRole = 'delete-role';

        $addPlante = 'add-plante';
        $editPlante = 'edit-plante';
        $deletePlante = 'delete-plante';
        $viewPlante = 'view-plante';

        $addCategory = 'add-Category';
        $editCategory = 'edit-Category';
        $deleteCategory = 'delete-Category';
        $viewCategory = 'view-Category';

        // create permissions
        // Permission::create(['name' => 'add plante']);
        // Permission::create(['name' => 'edit plante']);
        // Permission::create(['name' => 'delete plante']);
        // Permission::create(['name' => 'view plante']);


        $permission = collect([
            $viewCategory,
            $viewPlante,
            $addCategory,
            $addPlante,
            $deleteCategory,
            $deletePlante,
            $editCategory,
            $editPlante,
            // $addRole,
            // $editRole,
            // $deleteRole
        ])->map(function ($permission) {
            return [
                'name' => $permission, 'guard_name' => 'api'
            ];
        });

        Permission::insert($permission->toArray());

        //Define roles available

        $admin = 'admin';
        $seller = 'seller';
        $customer = 'customer';

        Role::create(['name' => $admin])->givePermissionTo(Permission::all());

        Role::create(['name' => $customer])
            ->givePermissionTo([
                $viewCategory,
                $viewPlante
            ]);
        Role::create(['name' => $seller])
            ->givePermissionTo([
                $viewCategory,
                $viewPlante,
                $addCategory,
                $addPlante,
                $deleteCategory,
                $deletePlante,
                $editCategory,
                $editPlante
            ]);

       
    }
}
