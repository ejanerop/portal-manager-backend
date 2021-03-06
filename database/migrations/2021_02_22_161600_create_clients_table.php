<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nick')->nullable(true);
            $table->ipAddress('ip_address');
            $table->string('desc')->nullable(true);
            $table->boolean('canSeePortal')->default(false);
            $table->unsignedBigInteger('client_type_id')->default(1);
            $table->foreign('client_type_id')->references('id')->on('client_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
