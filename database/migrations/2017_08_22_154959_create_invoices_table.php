<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('client_id');

            // address
            $table->string('name')->nullable();
            $table->string('street')->nullable();
            $table->string('address_addition')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // basics
            $table->date('invoice_date');
            $table->text('intro');
            $table->text('outro');
            $table->integer('payment_period');
            $table->float('sum')->nullable();

            // others
            $table->boolean('archived')->default(0);
            $table->date('pay_date')->nullable();
            $table->date('sent')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
