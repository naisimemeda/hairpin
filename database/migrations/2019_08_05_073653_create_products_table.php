<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table')->comment('标题');
            $table->text('description')->comment('商品详情');
            $table->string('image')->comment('封面图片');
            $table->unsignedInteger('sold_count')->default(0)->comment('销量');
            $table->unsignedBigInteger('shop_id')->comment('商家id');
            $table->boolean('on_sale')->default(true)->comment('商品是否正在售卖');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('products');
    }
}
