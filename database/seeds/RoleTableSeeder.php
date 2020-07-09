<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'write post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'publish post']);

        // Create Role
        $roleWriter = Role::create(['name' => 'writer']);
        $roleEditor = Role::create(['name' => 'editor']);
        $rolePublisher = Role::create(['name' => 'publisher']);
        $roleAdmin = Role::create(['name' => 'admin']);

        // Assign Permission to Role
        $roleWriter->givePermissionTo('write post');
        $roleEditor->givePermissionTo('edit post');
        $rolePublisher->givePermissionTo('publish post');
        $roleAdmin->givePermissionTo(Permission::all());
    }
}
