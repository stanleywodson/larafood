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
        Schema::create('cargo_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cargo::class)->references('id')
                ->on('cargos')
                ->onDelete('cascade');

            $table->foreignIdFor(\App\Models\Permission::class)->references('id')
                ->on('permissions')
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
        Schema::create('cargo_permission', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Cargo::class);
            $table->dropForeignIdFor(\App\Models\Permission::class);
        });
        Schema::dropIfExists('cargo_permission');
    }
};
