<?php

use App\Portal;
use Illuminate\Database\Seeder;

class PortalTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $portal = new Portal();
        $portal->name = 'Games';
        $portal->address_list = '4Games';
        $portal->dhcp_client = 'a4';
        $portal->save();

        $portal = new Portal();
        $portal->name = 'Descargas';
        $portal->address_list = '5Downloads';
        $portal->dhcp_client = 'a5';
        $portal->save();

        for ($i=6; $i < 30; $i++) {
            $portal = new Portal();
            $portal->name = 'Portal ' . $i;
            $portal->address_list = 'portal' . $i;
            $portal->dhcp_client = 'a'. $i;
            $portal->save();
        }

        for ($i=1; $i < 4 ; $i++) {
            $portal = new Portal();
            $portal->name = 'Nacional' . $i;
            $portal->address_list = '#!Nacional' . $i;
            $portal->dhcp_client = 'a' . $i;
            $portal->save();
        }

    }
}
