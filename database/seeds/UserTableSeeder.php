<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'andamio';
        $user->password = bcrypt('andamio');
        $user->save();

        $user = new User();
        $user->username = 'mandinga';
        $user->password = bcrypt('8765432');
        $user->save();

        $user = new User();
        $user->username = 'eringo';
        $user->password = bcrypt('ringuiti');
        $user->save();
    }
}
