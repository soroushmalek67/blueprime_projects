<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('user_companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('address');
            $table->string('town_center');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('postal');
            $table->double('lat');
            $table->double('lng');
            $table->string('phone');
            $table->string('url');
            $table->string('naics')->index();
            $table->integer('employees')->unsigned();
            $table->string('revenue');
           	$table->string('established_at');
            $table->string('services');
            $table->string('description');
            $table->string('linkedin_url');
            $table->string('facebook_url');
            $table->string('twitter_url');
            $table->integer('twitter_followers')->unsigned();
            $table->integer('twitter_following')->unsigned();
            $table->integer('twitter_tweets')->unsigned();
            $table->string('naics_description')->nullable();
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
        Schema::drop('user_companies');
	}

}
