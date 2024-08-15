<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 'marketing' has customer, order, suborder
        // 'adminpool' has driver, truck, order, suborder, finance, signal, bengkel, sparepart
        // 'driver' has order, suborder, signal
        // 'finance' has order, suborder, truck
        // 'bengkel' has truck, sparepart, finance
        // 'manager' has adminpool, driver, finance, bengkel
        // 'mekanik' has bengkel

        $role = Role::findByName('marketing');
        $role->givePermissionTo('customer.create');
        $role->givePermissionTo('customer.read');
        $role->givePermissionTo('customer.update');
        $role->givePermissionTo('customer.delete');
        $role->givePermissionTo('order.create');
        $role->givePermissionTo('order.read');
        $role->givePermissionTo('order.update');
        $role->givePermissionTo('order.delete');
        $role->givePermissionTo('suborder.create');
        $role->givePermissionTo('suborder.read');
        $role->givePermissionTo('suborder.update');
        $role->givePermissionTo('suborder.delete');

        $role = Role::findByName('adminpool');
        $role->givePermissionTo('driver.create');
        $role->givePermissionTo('driver.read');
        $role->givePermissionTo('driver.update');
        $role->givePermissionTo('driver.delete');
        $role->givePermissionTo('truck.create');
        $role->givePermissionTo('truck.read');
        $role->givePermissionTo('truck.update');
        $role->givePermissionTo('truck.delete');
        $role->givePermissionTo('order.create');
        $role->givePermissionTo('order.read');
        $role->givePermissionTo('order.update');
        $role->givePermissionTo('order.delete');
        $role->givePermissionTo('suborder.create');
        $role->givePermissionTo('suborder.read');
        $role->givePermissionTo('suborder.update');
        $role->givePermissionTo('suborder.delete');
        $role->givePermissionTo('finance.create');
        $role->givePermissionTo('finance.read');
        $role->givePermissionTo('finance.update');
        $role->givePermissionTo('finance.delete');
        $role->givePermissionTo('signal.create');
        $role->givePermissionTo('signal.read');
        $role->givePermissionTo('signal.update');
        $role->givePermissionTo('signal.delete');
        $role->givePermissionTo('bengkel.create');
        $role->givePermissionTo('bengkel.read');
        $role->givePermissionTo('bengkel.update');
        $role->givePermissionTo('bengkel.delete');
        // $role->givePermissionTo('sparepart.create');
        // $role->givePermissionTo('sparepart.read');
        // $role->givePermissionTo('sparepart.update');
        // $role->givePermissionTo('sparepart.delete');

        $role = Role::findByName('driver');
        $role->givePermissionTo('order.create');
        $role->givePermissionTo('order.read');
        $role->givePermissionTo('order.update');
        $role->givePermissionTo('order.delete');
        $role->givePermissionTo('suborder.create');
        $role->givePermissionTo('suborder.read');
        $role->givePermissionTo('suborder.update');
        $role->givePermissionTo('suborder.delete');
        $role->givePermissionTo('signal.create');
        $role->givePermissionTo('signal.read');
        $role->givePermissionTo('signal.update');
        $role->givePermissionTo('signal.delete');

        $role = Role::findByName('finance');
        $role->givePermissionTo('order.create');
        $role->givePermissionTo('order.read');
        $role->givePermissionTo('order.update');
        $role->givePermissionTo('order.delete');
        $role->givePermissionTo('suborder.create');
        $role->givePermissionTo('suborder.read');
        $role->givePermissionTo('suborder.update');
        $role->givePermissionTo('suborder.delete');
        $role->givePermissionTo('truck.create');
        $role->givePermissionTo('truck.read');
        $role->givePermissionTo('truck.update');
        $role->givePermissionTo('truck.delete');

        $role = Role::findByName('bengkel');
        $role->givePermissionTo('truck.create');
        $role->givePermissionTo('truck.read');
        $role->givePermissionTo('truck.update');
        $role->givePermissionTo('truck.delete');
        // $role->givePermissionTo('sparepart.create');
        // $role->givePermissionTo('sparepart.read');
        // $role->givePermissionTo('sparepart.update');
        // $role->givePermissionTo('sparepart.delete');
        $role->givePermissionTo('finance.create');
        $role->givePermissionTo('finance.read');
        $role->givePermissionTo('finance.update');
        $role->givePermissionTo('finance.delete');

        $role = Role::findByName('manager');
        $role->givePermissionTo('adminpool.create');
        $role->givePermissionTo('adminpool.read');
        $role->givePermissionTo('adminpool.update');
        $role->givePermissionTo('adminpool.delete');
        $role->givePermissionTo('driver.create');
        $role->givePermissionTo('driver.read');
        $role->givePermissionTo('driver.update');
        $role->givePermissionTo('driver.delete');
        $role->givePermissionTo('finance.create');
        $role->givePermissionTo('finance.read');
        $role->givePermissionTo('finance.update');
        $role->givePermissionTo('finance.delete');
        $role->givePermissionTo('bengkel.create');
        $role->givePermissionTo('bengkel.read');
        $role->givePermissionTo('bengkel.update');
        $role->givePermissionTo('bengkel.delete');

        $role = Role::findByName('mekanik');
        $role->givePermissionTo('bengkel.create');
        $role->givePermissionTo('bengkel.read');
        $role->givePermissionTo('bengkel.update');
        $role->givePermissionTo('bengkel.delete');



    }
}
