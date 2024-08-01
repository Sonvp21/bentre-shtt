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
        Schema::create('technical_innovation_dossiers', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID của hồ sơ');
            $table->string('name')->comment('Tên hồ sơ');
            $table->string('unit_name')->comment('Tên đơn vị');
            $table->string('field')->comment('Lĩnh vực');
            //document use laravel media
            $table->dateTime('submission_date')->comment('Ngày nộp');
            $table->string('submission_status')->comment('Trạng thái hồ sơ: Đang xử lý, đã cấp, bị từ chối');
            
            $table->timestamps();
            $table-> softDeletes();
        });

        Schema::create('technical_innovation_committees', function (Blueprint $table) {
            $table->id()->comment('Mã ID của hội đồng');
            $table->foreignId('technical_id')->nullable()->constrained('technical_innovation_dossiers')->comment('Mã ID hồ sơ');
            $table->string('name')->comment('Tên hội đồng');
            $table->float('score')->comment('Điểm số');
            $table->timestamp('date')->comment('Thời gian chấm');
            $table->string('status')->comment('Trạng thái');

            $table->timestamps();
            $table-> softDeletes();
        });

        Schema::create('technical_innovation_results', function (Blueprint $table) {
            $table->id()->comment('Mã ID của kết quả');;
            $table->foreignId('technical_id')->nullable()->constrained('technical_innovation_dossiers')->comment('Mã ID hồ sơ');
            $table->year('year')->comment('Năm thi');
            $table->string('rank')->comment('Xếp hạng đạt được');
            $table->string('status')->comment('Trạng thái');
            //document use laravel media
            $table->timestamps();
            $table-> softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_innovation_results');
        Schema::dropIfExists('technical_innovation_committees');
        Schema::dropIfExists('technical_innovation_dossiers');
    }
};
