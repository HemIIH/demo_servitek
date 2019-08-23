<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');

            $table->float('amount');
            $table->date('valid_from');
            $table->date('valid_to')->nullable();

            $table->integer('editor')->default(1);
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
        Schema::dropIfExists('charge_rates');
    }
}
