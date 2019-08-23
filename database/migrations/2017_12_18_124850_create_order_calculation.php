<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_calculation', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');

            $table->float('hours');
            $table->float('other_costs')->default(0);
            $table->float('total_income')->default(0);
            $table->float('total_costs')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_calculation');
    }
}
