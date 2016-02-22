<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->string('iso', 2);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 128);
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
        });

        Schema::create('owner_statusses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
        });

        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('logo');
            $table->string('url', 128);
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('owner_statusses');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamps();
        });

        Schema::create('shipyards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('logo');
            $table->string('url', 128);
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->timestamps();
        });

        Schema::create('societies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class', 64);
            $table->string('code', 12);
            $table->string('url', 128);
            $table->timestamps();
        });

        Schema::create('ship_statusses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
        });

        Schema::create('ship_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
        });

        Schema::create('ships', function (Blueprint $table) {
            $table->increments('id');
            $table->date('built');
            $table->integer('imo');
            $table->string('callsign', 8);
            $table->integer('mmsi');
            $table->integer('grt');
            $table->integer('dwt');
            $table->decimal('length_oa');
            $table->decimal('length_bp');
            $table->decimal('width');
            $table->decimal('depth');
            $table->decimal('draught_load');
            $table->decimal('volume');
            $table->integer('pipe_count');
            $table->decimal('diam_suc_pipe');
            $table->decimal('diam_del_pipe');
            $table->decimal('dred_depth');
            $table->decimal('bucket_cap');
            $table->integer('total_power');
            $table->integer('cut_power');
            $table->integer('pump_power');
            $table->integer('propulsion');
            $table->decimal('speed_load');
            $table->decimal('speed_unload');
            $table->integer('trust_power');
            $table->integer('jet_pump_power');
            $table->string('image');
            $table->string('status');
            $table->text('note');
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('ship_statusses');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('ship_types');
            $table->integer('society_id')->unsigned();
            $table->foreign('society_id')->references('id')->on('societies');
            $table->timestamps();
        });

        Schema::create('ship_names', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->integer('ship_id')->unsigned();
            $table->foreign('ship_id')->references('id')->on('ships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_names');
        Schema::dropIfExists('ships');
        Schema::dropIfExists('ship_types');
        Schema::dropIfExists('ship_statusses');
        Schema::dropIfExists('societies');
        Schema::dropIfExists('shipyards');
        Schema::dropIfExists('owners');
        Schema::dropIfExists('owner_statusses');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('sessions');
    }
}
