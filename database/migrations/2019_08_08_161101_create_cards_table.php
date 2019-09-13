<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_no');
            $table->string('card_key');
            $table->unsignedBigInteger('shop_id')->comment('商家id');
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->boolean('status')->default(true);
            $table->dateTime('sell_time')->nullable()->comment('出售时间');
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
        Schema::dropIfExists('card_keys');
    }
}
