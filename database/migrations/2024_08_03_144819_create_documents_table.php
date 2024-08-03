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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name');
        
            $table->foreignId('patent_id')->nullable()->constrained('patents')->onDelete('cascade');
            $table->foreignId('trademark_id')->nullable()->constrained('trademarks')->onDelete('cascade');
            $table->foreignId('industrial_design_id')->nullable()->constrained('industrial_designs')->onDelete('cascade');
            $table->foreignId('initiative_dossier_id')->nullable()->constrained('initiative_dossiers')->onDelete('cascade');
            $table->foreignId('geographical_indication_id')->nullable()->constrained('geographical_indications')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('cascade');
            $table->foreignId('advisory_support_id')->nullable()->constrained('advisory_supports')->onDelete('cascade');
            $table->foreignId('infringement_id')->nullable()->constrained('infringements')->onDelete('cascade');
            $table->foreignId('technical_innovation_dossier_id')->nullable()->constrained('technical_innovation_dossiers')->onDelete('cascade');
            $table->foreignId('technical_innovation_result_id')->nullable()->constrained('technical_innovation_results')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
