<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', static function (Blueprint $table) {
            $table->id();
            $table->string('sort_name');
            $table->string('name');
            $table->string('phone_code');
        });
        Schema::create('states', static function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigInteger('country_id');
            $table->string('name');
        });
        Schema::create('cities', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('state_id');
        });
        Schema::create('places', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('country_id');
            $table->bigInteger('state_id');
            $table->bigInteger('city_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('places');
    }
}
