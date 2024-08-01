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
        Schema::create('questions', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID câu hỏi');
            $table->string('name_sender')->comment('Tên người gửi');
            $table->string('email')->comment('Địa chỉ email');
            
            $table->string('title')->comment('Tên câu hỏi');
            $table->text('content')->comment('Nội dung');
            $table->timestamp('question_date')->comment('Thời gian hỏi');
            $table->string('status')->comment('Trạng thái');

            $table->timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
