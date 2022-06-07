<?php

use App\Models\Profile;
use App\Models\Permission;
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
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Permission::class)->references('id')
                                                    ->on('permissions')
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
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->dropForeignIdFor(Permission::class);
            $table->dropForeignIdFor(Profile::class);
        });

        Schema::dropIfExists('permission_profile');
    }
};
