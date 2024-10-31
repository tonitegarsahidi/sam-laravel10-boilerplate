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
        Schema::create('subscription_user', function (Blueprint $table) {
            $table->id();
            $table->uuid('user')->index();
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('package')->constrained('subscription_master')->onDelete('cascade');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('expired_date')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['user', 'package'], 'unique_user_package');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_user');
    }
};
