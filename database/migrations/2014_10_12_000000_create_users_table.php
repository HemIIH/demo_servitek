<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('type');

            $table->string('name');

            $table->string('email')->unique();
            $table->string('cc_email');
            $table->string('password');
            $table->rememberToken();
            $table->string('photo')->nullable();

            $table->string('street')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();

            $table->text('signature')->nullable();

            $table->boolean('active')->default(false);
            $table->boolean('activated')->default(false);

            $table->json('locations')->nullable();

            $table->integer('created_by');

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
        Schema::dropIfExists('users');
    }
}
