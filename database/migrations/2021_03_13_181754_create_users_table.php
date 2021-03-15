<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("firstName");
            $table->string("lastName");
            $table->string("phoneNumber")->unique()->nullable();
            $table->string("email",100)->unique()->nullable();
            $table->string("password",100);
            $table->enum("type",\App\Models\User::TYPES)->default(\App\Models\User::TYPE_USER);
//            $table->string('verify_code',6)->nullable();
//            $table->timestamp('verify_at')->nullable();
            $table->string('city')->nullable();
            $table->string('specialty')->nullable();//تخصص
            $table->string('degree')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('workDay')->nullable();
            $table->string('hoursWork')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
