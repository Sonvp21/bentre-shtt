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
        Schema::create('advisory_supports', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID hỗ trợ');
            $table->string('title')->comment('Tên thông tin');
            $table->text('content')->comment('Nội dung');
            $table->text('status')->nullable()->comment('Ghi chú');
            $table->timestamp('published_at')->comment('Thời gian đăng');
            //image and document use laravel media
            $table->unsignedBigInteger('parent_id')->nullable()->comment('ID hỗ trợ cha');
            $table->timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory_supports');
    }
};
