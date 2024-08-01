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
        Schema::create('trademarks', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID của nhãn hiệu');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->geometry('geom')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('color')->nullable()->comment('Màu sắc');

            $table->string('name')->comment('Tên nhãn hiệu');
            $table->string('slug')->comment('Tên rút gọn')->unique();
            $table->text('description')->nullable()->comment('Mô tả');
            $table->foreignId('type_id')->nullable()->constrained('trademark_types')->comment('nhóm ngành');
            $table->string('owner')->comment('Tên chủ nhãn hiệu');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->string('contact')->nullable()->comment('Liên hệ');
            //document and image use laravel media

            $table->string('application_number', 20)->comment('Số đơn');
            $table->dateTime('submission_date')->comment('Ngày nộp');
            $table->string('submission_status')->comment('Trạng thái đơn: Đang xử lý, đã cấp, bị từ chối');
            $table->string('publication_number', 20)->nullable()->comment('Số công bố');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');
            $table->dateTime('out_of_date')->nullable()->comment('Ngày hết hạn');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trademarks');
    }
};
