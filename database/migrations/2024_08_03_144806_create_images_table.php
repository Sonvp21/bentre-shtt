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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name');
        
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('patent_id')->nullable()->constrained('patents')->onDelete('cascade');
            $table->foreignId('trademark_id')->nullable()->constrained('trademarks')->onDelete('cascade');
            $table->foreignId('industrial_design_id')->nullable()->constrained('industrial_designs')->onDelete('cascade');
            $table->foreignId('geographical_indication_id')->nullable()->constrained('geographical_indications')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('advisory_support_id')->nullable()->constrained('advisory_supports')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
