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
        Schema::create('industrial_design_types', function (Blueprint $table) {
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

            $table->foreignId('type_id')->nullable()->constrained('industrial_design_types')->comment('nhóm ngành');
            $table->string('name')->comment('Tên sáng chế');
            $table->text('description')->nullable()->comment('Tóm tắt nội dung');
            $table->string('owner')->nullable()->comment('Tên chủ nhãn hiệu');
            $table->string('address')->nullable()->comment('Địa chỉ');
            //document and image use table

            $table->string('filing_number', 20)->comment('Số đơn gốc');
            $table->dateTime('filing_date')->nullable()->comment('Ngày nộp đơn');
            $table->string('publication_number', 20)->nullable()->comment('Số công bố');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');

            $table->string('registration_number', 20)->nullable()->comment('Số bằng');
            $table->dateTime('registration_date')->nullable()->comment('Ngày cấp bằng');
            $table->dateTime('expiration_date')->nullable()->comment('Ngày hết hạn');

            $table->string('designer')->nullable()->comment('Người thiết kế');
            $table->string('designer_address')->nullable()->comment('Địa chỉ người thiết kế');
            $table->string('locarno_classes')->nullable()->comment('Phân loại locarno');
            $table->string('representative_name')->nullable()->comment('Tên đại diện pháp luật');
            $table->string('representative_address')->nullable()->comment('Địa chỉ đại diện pháp luật');

            // $table->string('status')->nullable()->comment('Trạng thái: Expired, GRANTED, Pending, Rejected, Withdrawn');
            $table->string('status')->nullable()->comment('Trạng thái: Hết hạn, Đã cấp phép, Đang chờ xử lý, Bị từ chối, Đã rút lại');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industrial_designs');
        Schema::dropIfExists('industrial_design_types');
    }
};
