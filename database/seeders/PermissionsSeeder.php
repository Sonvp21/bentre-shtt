<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'id' => '1',
                'module' => 'Sáng chế toàn văn',
                'action' => 'Sáng chế toàn văn',
                'parent_id' => 0,
                'key_code' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '2',
                'module' => 'Sáng chế toàn văn',
                'action' => 'Danh sách',
                'parent_id' => 1,
                'key_code' => 'patent_index',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '3',
                'module' => 'Sáng chế toàn văn',
                'action' => 'thêm',
                'parent_id' => 1,
                'key_code' => 'patent_create',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '4',
                'module' => 'Sáng chế toàn văn',
                'action' => 'sửa',
                'parent_id' => 1,
                'key_code' => 'patent_edit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '5',
                'module' => 'Sáng chế toàn văn',
                'action' => 'xoá',
                'parent_id' => 1,
                'key_code' => 'patent_destroy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
