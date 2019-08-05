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
            $table->bigIncrements('id');
            $table->string('no')->unique()->comment('订单号');
            $table->unsignedBigInteger('product_id')->comment('商品id');
            $table->unsignedBigInteger('product_sku_id')->comment('sku');
            $table->string('email');
            $table->string('phone');
            $table->unsignedInteger('amount')->comment('数量');
            $table->decimal('total_amount', 10, 2);
            $table->text('remark')->comment('订单备注');
            $table->dateTime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_method')->nullable()->comment('支付方式');
            $table->string('payment_no')->nullable()->comment('支付平台订单号');
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
        Schema::dropIfExists('orders');
    }
}
