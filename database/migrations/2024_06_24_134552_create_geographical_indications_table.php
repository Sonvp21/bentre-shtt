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
        Schema::create('geographical_indications', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID chỉ dẫn địa lý');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            
            $table->string('name')->comment('Tên sản phẩm');
            $table->string('management_unit')->comment('Đơn vị quản lý');
            $table->string('application_number')->comment('Số đơn');
            $table->string('certificate_number')->comment('Số văn bằng');
            $table->date('issue_date')->comment('Ngày cấp');
            $table->text('content')->comment('Nội dung');
            $table->string('authorized_unit')->comment('Đơn vị được quyền sử dụng');
            $table->string('status')->nullable()->comment('Ghi chú');
            //image and document use laravel media
            $table->timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographical_indications');
    }
};
