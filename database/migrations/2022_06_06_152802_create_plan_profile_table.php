<?php

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->references('id')
                                                    ->on('plans')
                                                    ->onDelete('cascade');

            $table->foreignIdFor(Profile::class)->references('id')
                                                ->on('profiles')
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
        Schema::create('plan_profile', function (Blueprint $table) {
            $table->dropForeignIdFor(Plan::class);
            $table->dropForeignIdFor(Profile::class);
        });
        Schema::dropIfExists('plan_profile');
    }
};
