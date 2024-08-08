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
        Schema::create('patents', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID của sáng chế');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('commune_id')->nullable()->constrained('communes');
            $table->geometry('geom')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('type_id')->nullable()->constrained('patent_types')->comment('Lĩnh vực công nghệ');

            $table->string('title')->comment('Tên sáng chế');
            $table->text('ipc_classes')->nullable()->comment('Lớp phân loại');
            $table->text('applicant')->comment('Chủ đơn');
            $table->text('applicant_address')->nullable()->comment('Địa chỉ chủ đơn');
            $table->text('inventor')->nullable()->comment('Tác giả');
            $table->text('inventor_address')->nullable()->comment('địa chỉ Tác giả');
            $table->text('other_inventor')->nullable()->comment('Tác giả khác');
            $table->text('abstract')->nullable()->comment('Tóm tắt');

            $table->string('application_type')->nullable()->comment('loại đơn: non - PCT SC, non-PCT Utility');
            $table->string('filing_number')->comment('Số đơn');
            $table->dateTime('filing_date')->nullable()->comment('Ngày nộp đơn');

            $table->string('publication_number')->nullable()->comment('Số công bố');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');

            $table->string('registration_number')->nullable()->comment('Số bằng');
            $table->dateTime('registration_date')->nullable()->comment('Ngày cấp bằng');
            $table->dateTime('expiration_date')->nullable()->comment('Ngày hết hạn');

            $table->text('representative_name')->nullable()->comment('Tên đại diện pháp luật');
            $table->text('representative_address')->nullable()->comment('Địa chỉ đại diện pháp luật');

            $table->string('status')->nullable()->comment('Trạng thái: 
            Chờ chia đơn ND, Chờ duyệt CV, Chờ thẩm định nội dung, Đã cập nhật Bản mô tả, 
            Đã công bố, Hết hạn hiệu lực VBBH, Từ chối cấp VBBH
            ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patents');
    }
};
