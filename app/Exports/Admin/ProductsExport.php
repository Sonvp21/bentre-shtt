<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    protected $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng products thành collection để export
        $data = [];

        foreach ($this->products as $patent) {
            $data[] = [
                'Huyện' => $patent['district_name'] ?? null,
                'Xã' => $patent['commune_name'] ?? null,
                'Tên sản phẩm' => $patent['name'] ?? null,
                'Chủ sở hữu' => $patent['owner'] ?? null,
                'Đại diện pháp luật' => $patent['representatives'] ?? null,
                'Địa chỉ' => $patent['address'] ?? null,
                'Liên hệ' => $patent['contact'] ?? null,
                'Ngày đăng ký' => $patent['submission_date'] ?? null,
                'Ghi chú' => $patent['status'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Huyện',
            'Xã',
            'Tên sản phẩm',
            'Chủ sở hữu',
            'Đại diện pháp luật',
            'Địa chỉ',
            'Liên hệ',
            'Ngày đăng ký',
            'Ghi chú',
        ];
    }
}
