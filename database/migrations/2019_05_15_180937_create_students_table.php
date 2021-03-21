<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('roll_number');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('phone')->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('cityofbirth')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('students');
    }
}
