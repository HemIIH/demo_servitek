<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('expired_at')->nullable();
            $table->dateTime('last_renew')->nullable();
            $table->enum('status', ['trail', 'active', 'deactive', 'past_due', 'suspend'])->nullable();
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
        Schema::dropIfExists('portal_settings');
    }
}
