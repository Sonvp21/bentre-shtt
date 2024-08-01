<?php

namespace App\Exports\Admin;

use App\Models\Admin\Commune;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommunesExport implements FromCollection, WithHeadings
{
    protected $communes;

    public function __construct($communes)
    {
        $this->communes = $communes;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->communes as $commune) {
            $data[] = [
                'Tên Xã' => $commune['name'] ?? null,
                'Tên Huyện' => $commune['district_name'] ?? null,
                'Diện tích' => $commune['area'] ?? null,
                'Dân số' => $commune['population'] ?? null,
                'Năm cập nhật' => $commune['updated_year'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Tên Xã',
            'Tên Huyện',
            'Diện tích',
            'Dân số',
            'Năm cập nhật',
        ];
    }
}
