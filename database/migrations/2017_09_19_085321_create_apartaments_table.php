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
            $table->double('apartament_geo_x','5','5');
            $table->double('apartament_geo_y','5','5');
            $table->string('apartament_address','200');
            $table->string('apartament_address_2','200');
            $table->string('apartament_city','200');
            $table->integer('apartament_rooms_number');
            $table->integer('apartament_beds');
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
