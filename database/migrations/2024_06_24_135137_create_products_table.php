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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID sản phẩm');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->string('name')->comment('Tên sản phẩm');
            $table->string('slug')->comment('Tên rút gọn')->unique();
            $table->string('owner')->comment('Chủ sở hữu');
            $table->string('address')->comment('Địa chỉ');
            $table->string('contact')->comment('Liên hệ');
            $table->string('representatives')->comment('Đại diện');
            //image and document use laravel media
            $table->text('status')->nullable()->comment('Ghi chú');
            $table->dateTime('submission_date')->comment('ngày đăng ký');
            $table->timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
