<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class)->references('id')->on('orders')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Product::class)->references('id')->on('products')->onDelete('cascade');
            $table->integer('qty');
            $table->double('price', 10, 2);
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
        Schema::create('order_product', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Order::class);
            $table->dropForeignIdFor(\App\Models\Product::class);
        });
        Schema::dropIfExists('order_product');
    }
};
