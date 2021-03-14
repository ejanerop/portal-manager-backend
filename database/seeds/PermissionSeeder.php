<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'see-portal';
        $permission->desc = 'Ver portal actual';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'see-logs';
        $permission->desc = 'Ver registro de acciones';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'change-portals';
        $permission->desc = 'Cerrar portales permitidos';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'see-users-in-portal';
        $permission->desc = 'Ver usuarios en el portal actual';
        $permission->save();
    }
}
