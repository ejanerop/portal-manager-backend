<?php

use App\ClientType;
use Illuminate\Database\Seeder;

class ClientTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new ClientType();
        $type->type = 'regular';
        $type->desc = 'Normal';
        $type->allowed_portals = 1;
        $type->save();

        $type = new ClientType();
        $type->type = 'gamer';
        $type->desc = 'Gamer';
        $type->allowed_portals = 2;
        $type->save();

        $type = new ClientType();
        $type->type = 'special';
        $type->desc = 'Especial';
        $type->allowed_portals = 5;
        $type->save();
    }
}
