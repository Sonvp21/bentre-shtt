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
        Schema::create('infringements', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID vi phạm');
            $table->string('name')->comment('Tên vi phạm');
            $table->text('content')->comment('Nội dung');
            $table->timestamp('date')->comment('Thời gian');
            $table->decimal('penalty_amount', 15, 2)->comment('Số tiền xử phạt');
            //document use laravel madia
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
        Schema::dropIfExists('infringements');
    }
};
