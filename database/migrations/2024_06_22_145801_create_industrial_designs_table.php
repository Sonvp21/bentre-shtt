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
        Schema::create('design_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('industrial_designs', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID của Kiểu dáng công nghiệp');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->geometry('geom')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('color')->nullable()->comment('Màu sắc');

            $table->foreignId('type_id')->nullable()->constrained('design_types')->comment('nhóm ngành');
            $table->string('name')->comment('Tên sáng chế');
            $table->string('slug')->comment('Tên rút gọn')->unique();
            $table->text('description')->nullable()->comment('Tóm tắt nội dung');
            $table->string('owner')->comment('Tên chủ nhãn hiệu');
            $table->string('address')->nullable()->comment('Địa chỉ');
            //document and image

            $table->string('application_number', 20)->comment('Số đơn gốc');
            $table->dateTime('submission_date')->nullable()->comment('Ngày nộp');
            $table->string('submission_status')->nullable()->comment('Trạng thái đơn: Đang xử lý, đã cấp, bị từ chối');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');
            $table->string('publication_number', 20)->nullable()->comment('Số công bố');

            $table->dateTime('design_date')->nullable()->comment('Ngày cấp');
            $table->dateTime('design_out_of_date')->nullable()->comment('Ngày hết hạn');
            $table->string('design_status')->nullable()->comment('Trạng thái: Hiệu lực, hết hạn, bị huỷ');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('design_types');
        Schema::dropIfExists('industrial_designs');
    }
};
