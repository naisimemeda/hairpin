<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shop_id')->index();
            $table->string('code')->unique()->comment('优惠码，用户下单时输入');
            $table->string('type')->comment('优惠券类型，支持固定金额和百分比折扣');
            $table->decimal('value')->comment('折扣值，根据不同类型含义不同');
            $table->unsignedInteger('total')->comment('可用的数量');
            $table->unsignedInteger('used')->default(0)->comment('已用的数量');
            $table->decimal('min_amount', 10, 2)->comment('使用该优惠券的最低订单金额');
            $table->boolean('enabled')->comment('优惠券是否生效');
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
        Schema::dropIfExists('coupon_codes');
    }
}
