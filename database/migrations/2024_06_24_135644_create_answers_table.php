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
        Schema::create('answers', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID câu trả lời');
            $table->foreignId('question_id')->constrained('questions')->nullable()->comment('Mã ID câu hỏi');
            $table->foreignId('user_id')->constrained('users')->nullable()->comment('Người trả lời');
            
            $table->string('responder')->comment('Người trả lời');
            $table->text('answer')->comment('Nội dung trả lời');
            $table->timestamp('answer_date')->comment('Thời gian trả lời');
            $table->integer('view')->default(0)->comment('Lượt xem');
            $table->string('status')->comment('Trạng thái');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
