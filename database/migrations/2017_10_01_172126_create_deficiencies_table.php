<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeficienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deficiencies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('note')->nullable();

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');

            $table->boolean('completed')->default(false);

            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff');        

            //department tagged separately in the event that a staff moves 
            //to another department
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');

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
        Schema::dropIfExists('deficiencies');
    }
}
