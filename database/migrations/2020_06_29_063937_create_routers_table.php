<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sap_id')
                ->unique();
            $table->enum('type', ['AG1', 'CSS'])
                ->default('AG1');
            $table->string('host_name')
                ->unique();
            $table->ipAddress('loopback')
                ->unique();
            $table->macAddress('mac_address')
                ->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routers');
    }
}
