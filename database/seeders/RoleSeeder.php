<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name'=>'Admin']);
        $role2=Role::create(['name'=>'Storekeeper']);

        Permission::create(['name'=>'admin.user'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.category'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.client'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.detail'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.order'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.payment-method'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.product'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.sale'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.sale-type'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.supplier'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.acquisition'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.purchase-order'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.order_detail'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.payment-status'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'admin.order-status'])->syncRoles([$role1,$role2]);
    }
}
