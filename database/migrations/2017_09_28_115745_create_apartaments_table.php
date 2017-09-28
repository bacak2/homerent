<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartaments', function (Blueprint $table) {
            $table->increments('id');
            $table->double('apartament_geo_x','10','5');
            $table->double('apartament_geo_y','10','5');
            $table->string('apartament_address','200');
            $table->string('apartament_address_2','200');
            $table->string('apartament_city','200');
            $table->integer('apartament_rooms_number');
            $table->integer('apartament_beds');
            $table->integer('group_id')->unsigned();
            $table->integer('owner_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('apartament_groups');
            $table->foreign('owner_id')->references('id')->on('owners');
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
        Schema::dropIfExists('apartaments');
    }
}
