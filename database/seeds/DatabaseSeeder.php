<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientTypeTableSeeder::class);
        $this->call(LogTypeTableSeeder::class);
        $this->call(PortalTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(PermissionSeeder::class);
    }
}
