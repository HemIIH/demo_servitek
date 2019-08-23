<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('invoice_id');
            $table->integer('order_id')->nullable();
            $table->string('type');

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->string('service');
            $table->string('unit');
            $table->float('quantity');

            $table->float('price')->nullable();
            $table->integer('tax_rate')->default(0);
            $table->integer('discount')->default(0);
            $table->float('sum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
