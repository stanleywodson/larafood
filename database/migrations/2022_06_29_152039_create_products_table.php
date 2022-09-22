<?php

use App\Models\Tenant;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tenant::class)->references('id')->on('tenants')->onDelete('cascade');
            $table->uuid('uuid');
            $table->string('title')->unique();
            $table->string('flag')->unique();
            $table->string('image');
            $table->double('price', 10, 2);
            $table->text('description');
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
        Schema::create('products', function (Blueprint $table) {
            $table->dropForeignIdFor(Tenant::class);
        });
        Schema::dropIfExists('products');
    }
};
