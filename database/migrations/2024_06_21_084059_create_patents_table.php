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
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->geometry('geom')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();

            $table->string('code', 20)->comment('Mã số');
            $table->string('name')->comment('Tên sáng chế');
            $table->string('slug')->comment('Tên rút gọn')->unique();
            $table->text('description')->nullable()->comment('Tóm tắt nội dung');
            $table->string('legal_representative')->comment('Đại diện pháp luật');
            $table->text('document')->nullable()->comment('Hồ sơ liên quan');

            $table->string('application_number', 20)->comment('Số đơn');
            $table->dateTime('submission_date')->nullable()->comment('Ngày nộp');
            $table->string('submission_status')->nullable()->comment('Trạng thái đơn: Đang xử lý, đã cấp, bị từ chối');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');

            $table->string('number_patent', 20)->nullable()->comment('Số bằng');
            $table->dateTime('patent_date')->nullable()->comment('Ngày cấp');
            $table->dateTime('patent_out_of_date')->nullable()->comment('Ngày hết hạn');
            $table->string('patent_status')->nullable()->comment('Trạng thái: Hiệu lực, hết hạn, bị huỷ');

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
