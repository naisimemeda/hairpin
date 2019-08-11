<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('商家名称');
            $table->string('phone');
            $table->string('password');
            $table->string('email')->nullable();
            $table->integer('status')->default(1);
            $table->string('avatar')->nullable();
            $table->string('notice')->nullable();
            $table->decimal('money', 10, 2)->default(0);
            $table->decimal('frozen_money', 10, 2)->default(0)->comment('第二天可提现金额');
            $table->decimal('complaint_money', 10, 2)->default(0)->comment('投诉冻结金额');
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
        Schema::dropIfExists('shop');
    }
}
