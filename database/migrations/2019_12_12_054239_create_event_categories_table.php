<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {		
		Schema::create('event_categories', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('event_id');
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedInteger('category_id')->nullable();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('event_categories');
    }
}
