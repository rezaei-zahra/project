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
            $table->string("email",100)->unique()->nullable();//نام کاربری
            $table->string("password",100);
            $table->enum("role",\App\Models\User::ROLES);
            $table->string("phoneNumber")->unique()->nullable();
            $table->string('city')->nullable();
            $table->string('specialty')->nullable();//تخصص
            $table->string('degree')->nullable();//مدرک
            $table->string('systemNumber')->unique()->nullable();//شماره نظام پزشکی
            $table->string('address')->nullable();

            $table->timestamps();
//            $table->softDeletes();
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
