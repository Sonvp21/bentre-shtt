<?php

namespace App\Exports\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DistrictsExport implements FromCollection, WithHeadings
{
    protected $districts;

    public function __construct(array $districts)
    {
        $this->districts = $districts;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng districts thành collection để export
        $data = [];

        foreach ($this->districts as $district) {
            $data[] = [
                'Tên Huyện' => $district['name'] ?? null,
                'Diện tích' => $district['area'] ?? null,
                'Dân số' => $district['population'] ?? null,
                'Năm cập nhật' => $district['updated_year'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Tên Huyện',
            'Diện tích',
            'Dân số',
            'Năm cập nhật',
        ];
    }
}
