<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $adminRole = Role::create([ 'name' => 'admin', 'guard_name'=>'api']);
        $managerRole = Role::create([ 'name' => 'manager', 'guard_name'=>'api']);
        $userRole = Role::create([ 'name' => 'user', 'guard_name'=>'api']);

         // Permissions
        Permission::create(['name' => 'write-a-job', 'guard_name'=>'api']);
        Permission::create(['name' => 'edit-a-job', 'guard_name'=>'api']);
        Permission::create(['name' => 'delete-a-job', 'guard_name'=>'api']);
        Permission::create(['name' => 'view-a-job', 'guard_name'=>'api']);

        // Assign permissions to role
        $adminRole->syncPermissions(['write-a-job', 'edit-a-job', 'delete-a-job', 'view-a-job']);
        $managerRole->syncPermissions(['edit-a-job', 'view-a-job']);
        $userRole->syncPermissions(['view-a-job']);

        // Assign roles to users
        $user = User::find(1); 
        $user->syncRoles(['admin']);
        $user->syncPermissions(['write-a-job', 'edit-a-job', 'delete-a-job', 'view-a-job']);

        $user2 = User::find(2); 
        $user2->syncRoles(['manager']);
        $user2->syncPermissions(['edit-a-job', 'view-a-job']);
    }
}
