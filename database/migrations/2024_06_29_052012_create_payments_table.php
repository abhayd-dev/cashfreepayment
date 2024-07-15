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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->decimal('amount', 10, 2);
            $table->string('order_id')->unique();
            $table->string('payment_id')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('order_token')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
