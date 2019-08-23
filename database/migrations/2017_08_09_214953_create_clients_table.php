<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();

            $table->string('name');
            $table->string('short_name');

            // address
            $table->string('street');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');

            $table->string('iban')->nullable();
            $table->string('bic')->nullable();

            $table->boolean('active')->default(1);

            $table->string('logo')->nullable();
            $table->string('type_of_contract')->nullable();

            $table->string('vat')->nullable();

            $table->string('location')->nullable();

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
        Schema::dropIfExists('clients');
    }
}
