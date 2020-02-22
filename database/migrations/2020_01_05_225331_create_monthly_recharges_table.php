<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyRechargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_recharges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount');
            $table->date('date');
            $table->date('monthReference');

            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('card_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_recharges');
    }
}
