<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('project_companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->integer('project_id')->unsigned()->index();
            $table->string('matching_source');
            $table->integer('matching_company_id')->unsigned()->index();
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
        Schema::drop('project_companies');
	}

}
