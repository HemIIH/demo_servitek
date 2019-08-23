<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_business', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');

            $table->string('type');
            $table->date('date');
            $table->float('hours');
            $table->integer('total_min');
            $table->text('information')->nullable();

            $table->integer('editor');
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
        Schema::dropIfExists('extra_business');
    }
}
