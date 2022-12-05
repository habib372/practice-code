<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('father_name');
            $table->date('date_of_birth');
            $table->string('education');
            $table->text('permanent_address');
            $table->string('upazila');
            $table->string('district');
            $table->text('present_address');
            $table->string('mobile');
            $table->text('email');
            $table->text('passport_image');
            $table->text('nid_front_part');
            $table->text('nid_back_part');
            $table->text('message');
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
        Schema::dropIfExists('agents');
    }
}
