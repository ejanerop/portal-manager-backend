<?php

use App\LogType;
use Illuminate\Database\Seeder;

class LogTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $logType = new LogType();
        $logType->type = 'close';
        $logType->desc =  'Cierre de portal';
        $logType->save();

        $logType = new LogType();
        $logType->type = 'change';
        $logType->desc =  'Cambio a portal';
        $logType->save();

    }
}
