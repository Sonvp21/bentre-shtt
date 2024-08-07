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
            $table->geometry('geom')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('type_id')->nullable()->constrained('trademark_types')->comment('nhóm sản phẩm/dịch vụ');

            $table->text('mark')->nullable()->comment('Tên nhãn hiệu');
            $table->string('mark_colors')->nullable()->comment('Màu nhãn hiệu');
            $table->text('mark_feature')->nullable()->comment('Kiểu của mẫu nhãn(Hình ảnh/Chữ viết/Kết hợp) Image-Based/Text-Based/Combined');
            $table->text('vienna_classes')->nullable()->comment('Phân loại hình');
            $table->text('disclaimer')->nullable()->comment('Yếu tố loại trừ: Nhãn hiệu được bảo hộ tổng thể. Không bảo hộ riêng:... men nấu rượu và hình cây dừa...');
            $table->text('owner')->comment('Tên chủ nhãn hiệu');
            $table->text('address')->nullable()->comment('Địa chỉ');
            $table->text('other_owner')->nullable()->comment('Tên chủ khác/ tên kèm đại chỉ');
            //document and image use table

            $table->string('application_type')->nullable()->comment('loại đơn: Thông thường, Tập thể, Chứng nhận');
            $table->string('filing_number')->comment('Số đơn');
            $table->dateTime('filing_date')->nullable()->comment('Ngày nộp đơn');

            $table->string('publication_number')->nullable()->comment('Số công bố');
            $table->dateTime('publication_date')->nullable()->comment('Ngày công bố');

            $table->string('registration_number')->nullable()->comment('Số bằng');
            $table->dateTime('registration_date')->nullable()->comment('Ngày cấp bằng');
            $table->dateTime('expiration_date')->nullable()->comment('Ngày hết hạn');
           
            $table->text('representative_name')->nullable()->comment('Tên đại diện pháp luật');
            $table->text('representative_address')->nullable()->comment('Địa chỉ đại diện pháp luật');

            $table->string('status')->nullable()->comment('Trạng thái: Cấp bằng, Đang giải quyết, Hết hạn, Rút đơn, Từ bỏ, Từ chối');
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
