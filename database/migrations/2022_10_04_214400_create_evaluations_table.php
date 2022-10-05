<?php

use App\Models\Client;
use App\Models\Order;
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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->integer('stars');
            $table->foreignIdFor(Order::class)->references('id')->on('orders')->onDelete('cascade');
            $table->foreignIdFor(Client::class)->references('id')->on('clients')->onDelete('cascade');
            $table->text('comments')->nullable();
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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->dropForeignIdFor(Order::class);
            $table->dropForeignIdFor(Client::class);
        });
        Schema::dropIfExists('evaluations');
    }
};
