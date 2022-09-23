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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Tenant::class)->references('id')->on('tenants')->onDelete('cascade');
            $table->string('identify')->unique();
            $table->integer('client_id')->nullable();
            $table->integer('table_id')->nullable();
            $table->double('total', 10, 2);
            $table->enum('status', ['open', 'done', 'rejected', 'working', 'canceled', 'delivering']);
            $table->text('comment')->nullable();
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
        Schema::create('orders', function (Blueprint $table) {
            $table->dropForeignIdFor(Tenant::class);
        });
        Schema::dropIfExists('orders');

    }
};
