<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_salaries', function (Blueprint $table) {
            $table->increments('id');

            $table->string('region');
            $table->integer('salary_group');
            $table->float('base_amount');
            $table->float('extra_pay');
            $table->date('valid_from');

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
        Schema::dropIfExists('legal_salaries');
    }
}
