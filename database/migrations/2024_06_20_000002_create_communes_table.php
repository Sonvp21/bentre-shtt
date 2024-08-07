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
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->geometry('geom'); // Sử dụng kiểu dữ liệu geometry nếu `geom` là dữ liệu địa lý
            $table->string('name');
            $table->foreignId('district_id')->constrained('districts');
            $table->float('area')->nullable(); // Sử dụng kiểu dữ liệu số thay vì chuỗi
            $table->float('population')->nullable(); // Sử dụng kiểu dữ liệu số thay vì chuỗi
            $table->string('updated_year')->nullable(); // Sử dụng kiểu dữ liệu ngày tháng
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
