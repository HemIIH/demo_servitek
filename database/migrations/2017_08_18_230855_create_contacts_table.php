<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');

            // basics
            $table->char('sex', 1);
            $table->string('first_name');
            $table->string('last_name');

            // responsibility
            $table->string('function')->nullable();
            $table->boolean('personnel_planning')->nullable()->default(false);
            $table->boolean('accounting')->nullable()->default(false);
            $table->boolean('other')->nullable()->default(false);

            // contacts
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();

            $table->text('information')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('contacts');
    }
}
