<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');

            // address
            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('address_addition')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // invoice related
            $table->text('intro')->nullable();
            $table->text('outro')->nullable();
            $table->integer('default_tax_rate')->default(19);
            $table->string('payment_period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_data');
    }
}
