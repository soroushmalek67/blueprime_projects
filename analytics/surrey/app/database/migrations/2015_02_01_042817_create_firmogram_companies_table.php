<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmogramCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('firmogram_companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('name_2')->index();
            $table->string('address'); //address 1
			$table->string('address_2')->nullable(); //address 2
            $table->string('town_center');
			$table->string('city');
			$table->string('postal'); //postal
			$table->string('province');
			$table->string('country');
			$table->string('phone');
			$table->string('url');
            $table->string('naics')->index();
            $table->string('naics_2')->index();
            $table->string('contact_1_first_name');
            $table->string('contact_1_last_name');
            $table->string('contact_2_first_name');
            $table->string('contact_2_last_name');
            $table->string('contact_3_first_name');
            $table->string('contact_3_last_name');
            $table->string('nationality');
            $table->string('established_at');
            $table->string('revenue');
            $table->integer('employees');
            $table->string('services');
            $table->string('description');
            $table->double('lat');
            $table->double('lng');
            $table->string('naics_description')->nullable();
            $table->string('naics_2_description')->nullable();
            $table->string('database_name')->nullable();
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
        Schema::drop('firmogram_companies');
	}

}
