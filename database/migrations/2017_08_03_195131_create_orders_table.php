<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            // parent
            $table->boolean('is_parent')->default(0);
            $table->integer('parent_id')->nullable();

            $table->integer('client_id');

            // basics
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time')->nullable();

            $table->string('work_location');
            $table->string('meeting_point');
            $table->time('meeting_time');
            $table->text('requirements');
            $table->string('client_location');

            $table->json('important_change')->nullable();

            // staff
            $table->integer('staff_planned')->default(0);
            $table->integer('staff_required');

            // flags
            $table->enum('status', ['active', 'requested', 'canceled'])->default('active');
            $table->boolean('public')->default(0);
            $table->boolean('time_recorded')->default(0);
            $table->boolean('billed')->default(0);
            $table->dateTime('sent')->nullable();

            // accounting
            $table->integer('total_min')->default(0);
            $table->float('total_income')->default(0);
            $table->float('total_wage')->default(0);
            $table->float('total_cost')->default(0);
            $table->float('other_costs')->default(0);

            // meta
            $table->integer('created_by')->nullable();
            $table->integer('edited_by')->nullable();
            $table->integer('requested_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
