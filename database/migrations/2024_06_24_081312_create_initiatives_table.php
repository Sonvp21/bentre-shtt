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
        Schema::create('initiatives', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID sáng kiến');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('name')->comment('Tên sáng kiến');
            $table->string('slug');
            $table->string('author')->comment('Tác giả');
            $table->string('owner')->comment('Chủ sở hữu');
            $table->string('address')->comment('Địa chỉ');
            $table->string('fields')->comment('Lĩnh vực');
            $table->year('recognition_year')->nullable()->comment('Năm công nhận');
            
            $table->string('status')->nullable()->comment('trạng thái');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('initiative_dossiers', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID hồ sơ');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('initiative_id')->nullable()->constrained('initiatives');
            $table->string('name')->comment('Tên hồ sơ');
            $table->string('slug');
            //document use laravel media
            $table->timestamp('submission_date')->comment('Thời gian nộp');
            $table->string('submission_status')->comment('Trạng thái hồ sơ');
            $table->string('comment')->nullable()->comment('Nhận xét');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('initiative_evaluates', function (Blueprint $table) {
            $table->id('id')->comment('Mã ID hội đồng');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('initiative_dossier_id')->nullable()->constrained('initiative_dossiers')->comment('Mã ID hồ sơ');

            $table->string('name_evaluation')->comment('Tên hội đồng');
            $table->string('slug');
            $table->string('name_member')->comment('Tên thành viên');
            $table->float('score')->nullable()->comment('Điểm số');
            $table->timestamp('submission_date')->nullable()->comment('Thời gian chấm');
            $table->string('submission_status')->nullable()->comment('Trạng thái:Chờ xử lý, Đang xử lý, Được phê duyệt, Bị từ chối');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('initiative_evaluates');
        Schema::dropIfExists('initiative_dossiers');
        Schema::dropIfExists('initiatives');
        
    }
};
