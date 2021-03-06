<?php

use App\Client;
use App\ClientType;
use App\Portal;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {

        $gamer = ClientType::where('type', 'gamer')->first();
        $special = ClientType::where('type', 'special')->first();
        $regular = ClientType::where('type', 'regular')->first();
        $portal = Portal::find(1);

        for ($i=1; $i < 121; $i++) {
            $client = new Client();
            $client->ip_address = '192.168.20.' . $i ;
            $client->client_type()->associate($regular);
            $client->save();
            $client->portals()->attach($portal);
        }

    }
}
