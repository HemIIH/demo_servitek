<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_order', function(Blueprint $table) {
            $table->integer('employee_id');
            $table->integer('order_id');

            $table->string('role')->default('-');
            $table->string('working_area')->default('-');
            $table->boolean('approved_by_employee')->nullable();
            $table->boolean('rejected_by_employee')->nullable();

            $table->dateTime('employee_available')->nullable();
            $table->dateTime('employee_not_available')->nullable();

            $table->string('meeting_point')->nullable();
            $table->time('meeting_time')->nullable();

            // meta info
            $table->dateTime('sent')->nullable();
            $table->string('sent_by')->nullable();
            $table->string('edited_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_order');
    }
}
