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
    Schema::create('chart_of_accounts', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();        
        $table->unsignedBigInteger('parent_id')->nullable();
        $table->string('identification_no')->nullable();
        $table->string('account_currency')->nullable();
        $table->unsignedBigInteger('customer_id')->nullable();
        $table->unsignedBigInteger('industry_id')->nullable();
        $table->text('descriptions')->nullable();
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->timestamps(); 
      
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_of_accounts');
    }
};
