<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_list_items', function (Blueprint $table) {
            $table->increments('id');

			$table->string('title');

			$table->string('note')->nullable();

			$table->string('slug');

			$table->integer('task_list_id')->unsigned();
			$table->foreign('task_list_id')->references('id')->on('task_lists');

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
        Schema::dropIfExists('task_list_items');
    }
}
