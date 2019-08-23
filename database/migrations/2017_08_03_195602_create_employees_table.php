<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();

            // basics
            $table->char('sex', 1);
            $table->string('first_name');
            $table->string('last_name');

            // birthday
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();

            // personal
            $table->boolean('married')->default(0);
            $table->integer('children')->default(0);
            $table->string('disability')->nullable();
            $table->string('education_level')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality');

            $table->json('locations')->default('');

            // address
            $table->string('street');
            $table->string('postal_code');
            $table->string('city');

            // contacts
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();

            $table->string('photo')->nullable();
            $table->string('signature')->nullable();

            $table->string('type_of_health_insurance');
            $table->string('health_insurance');
            $table->string('social_security_number')->nullable();
            $table->string('tax_id')->nullable();
            $table->integer('tax_class')->nullable();

            // bank account
            $table->string('account_holder')->nullable();
            $table->string('institute')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic')->nullable();

            $table->boolean('active')->default(1);
            $table->boolean('applicant')->default(0);

            // contract
            $table->string('occupation_type')->default('');
            $table->integer('contractual_working_hours')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('exit_date')->nullable();

            $table->float('working_time_account')->default(0);

            $table->boolean('car')->default(0);
            $table->boolean('driving_license')->default(0);
            $table->boolean('public_transportation')->default(0);

            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
