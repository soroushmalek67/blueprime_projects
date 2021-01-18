<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyCapabilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('company_capabilities', function(Blueprint $table) {
        	$table->increments('id');
        	$table->integer('project_id')->unsigned()->index();
            $table->integer('company_id')->unsigned()->index();
            $table->string('title');
            $table->string('description');
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
        Schema::drop('company_capabilities');
	}

}
