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
            $table->id();
            $table->string('name');
            $table->string('father_name');
            $table->date('date_of_birth');
            $table->string('education');
            $table->text('permanent_address');
            $table->string('upazila');
            $table->string('district');
            $table->text('present_address');
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->unique();
            $table->string('passport_image');
            $table->string('nid_front_part');
            $table->string('nid_back_part');
            $table->text('message');
            $table->longText('description')->nullable();
            $table->string('display')->default('none');
            $table->string('image')->default('photo.jpg');
            $table->longText('video')->nullable();
            $table->integer('status')->default(0);
            $table->dateTime('created_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->tinyInteger('featured')->nullable()->default(0);
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->timestamp('failed_at')->useCurrent();
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
// specific file migrate

php artisan migrate --path=/database/migrations/test.php

C:\xampp\htdocs\web-development\Fightingcancerbd.com\tsrhealth/C:/Program Files/Git/database/migrations/test/2023_07_12_113336_create_admanagers_table.php'