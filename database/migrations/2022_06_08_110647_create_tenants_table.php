<?php

use App\Models\Plan;
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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Plan::class)->references('id')->on('plans');
            $table->uuid('uuid');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();

            // Status tenant (se tiver N ele perde o acesso do sistema)
            $table->enum('active', ['Y', 'N'])->default('Y');

            $table->date('subscription')->nullable(); //data de inscrição
            $table->date('expires_at')->nullable(); //data de expiração
            $table->string('subscription_id')->nullable(); //identifcação do gateway de pagamento
            $table->boolean('subscription_active')->default(false); //active
            $table->boolean('subscription_suspended')->default(false); //assinatura cancelada
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
        Schema::create('tenants', function (Blueprint $table) {
            $table->dropForeignIdFor(Plan::class);
        });

        Schema::dropIfExists('tenants');
    }
};
