<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingTimeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_time_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('date');
            $table->float('target');
            $table->float('actual')->default(0);
            $table->float('balance')->default(0);
            $table->boolean('starting_value')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('working_time_accounts');
    }
}
