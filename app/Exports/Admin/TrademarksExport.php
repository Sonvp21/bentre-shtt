<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TrademarksExport implements FromCollection, WithHeadings
{
    protected $trademarks;

    public function __construct(array $trademarks)
    {
        $this->trademarks = $trademarks;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng trademarks thành collection để export
        $data = [];

        foreach ($this->trademarks as $trademark) {
            $data[] = [
                'Huyện' => $trademark['district_name'] ?? null,
                'Xã' => $trademark['commune_name'] ?? null,
                'Nhóm ngành' => $trademark['type_name'] ?? null,
                'Tên nhãn hiệu' => $trademark['name'] ?? null,
                'Chủ nhãn hiệu' => $trademark['owner'] ?? null,
                'Mô tả' => $trademark['description'] ?? null,
                'Địa chỉ' => $trademark['address'] ?? null,
                'Liên hệ' => $trademark['contact'] ?? null,
                'Số đơn' => $trademark['application_number'] ?? null,
                'Ngày nộp đơn' => $trademark['submission_date'] ?? null,
                'Trạng thái đơn' => $trademark['submission_status_text'] ?? null,
                'Số công bố' => $trademark['publication_number'] ?? null,
                'Ngày công bố' => $trademark['publication_date'] ?? null,
                'Ngày hết hạn' => $trademark['out_of_date'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Huyện',
            'Xã',
            'Nhóm ngành',
            'Tên nhãn hiệu',
            'Chủ nhãn hiệu' ,
            'Mô tả',
            'Địa chỉ',
            'Liên hệ',
            'Số đơn',
            'Ngày nộp đơn' ,
            'Trạng thái đơn',
            'Số công bố',
            'Ngày công bố',
            'Ngày hết hạn',
        ];
    }
}
