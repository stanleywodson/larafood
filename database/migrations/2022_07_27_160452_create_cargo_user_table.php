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
        Schema::create('cargo_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cargo::class)->references('id')
                ->on('cargos')
                ->onDelete('cascade');

            $table->foreignIdFor(\App\Models\User::class)->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('cargo_user', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Cargo::class);
            $table->dropForeignIdFor(\App\Models\User::class);
        });
        Schema::dropIfExists('cargo_user');
    }
};
