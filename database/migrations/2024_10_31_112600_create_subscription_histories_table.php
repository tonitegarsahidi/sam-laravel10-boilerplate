<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_history', function (Blueprint $table) {
            $table->id();
            // Reference to subscription_user
            $table->foreignId('subscription_user_id')->constrained('subscription_user')->onDelete('cascade');

            $table->decimal('package_price_snapshot', 10, 2)->nullable();
            $table->smallInteger('subscription_action')->default(1);
            $table->string('payment_reference')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_history');
    }
};
