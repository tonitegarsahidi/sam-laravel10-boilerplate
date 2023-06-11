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
        Schema::create('srq20result', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->tinyInteger('sex')->nullable();//1 male, 2 female
            $table->string('ipaddress')->nullable();
            $table->boolean('q1')->default(false);
            $table->boolean('q2')->default(false);
            $table->boolean('q3')->default(false);
            $table->boolean('q4')->default(false);
            $table->boolean('q5')->default(false);
            $table->boolean('q6')->default(false);
            $table->boolean('q7')->default(false);
            $table->boolean('q8')->default(false);
            $table->boolean('q9')->default(false);
            $table->boolean('q10')->default(false);
            $table->boolean('q11')->default(false);
            $table->boolean('q12')->default(false);
            $table->boolean('q13')->default(false);
            $table->boolean('q14')->default(false);
            $table->boolean('q15')->default(false);
            $table->boolean('q16')->default(false);
            $table->boolean('q17')->default(false);
            $table->boolean('q18')->default(false);
            $table->boolean('q19')->default(false);
            $table->boolean('q20')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('srq20result');
    }
};
