<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('postal_codes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('postal', 6)->index();
            $table->double('lat');
            $table->double('lng');
            $table->string('city', 50);
            $table->string('province', 2);
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
        Schema::drop('postal_codes');
	}

}
