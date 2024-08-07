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

                'Tên nhãn hiệu' => $trademark['mark'] ?? null,
                'Màu nhãn hiệu' => $trademark['mark_colors'] ?? null,
                'Kiểu mẫu nhãn' => $trademark['mark_feature'] ?? null,
                'Phân loại hình' => $trademark['vienna_classes'] ?? null,
                'Yếu tố loại trừ' => $trademark['disclaimer'] ?? null,
                'Chủ nhãn hiệu' => $trademark['owner'] ?? null,
                'Địa chỉ' => $trademark['address'] ?? null,
                'Tên chủ khác' => $trademark['other_owner'] ?? null,

                'Loại đơn' => $trademark['application_type'] ?? null,
                'Số đơn' => $trademark['filing_number'] ?? null,
                'Ngày nộp đơn' => $trademark['filing_date'] ?? null,

                'Số công bố' => $trademark['publication_number'] ?? null,
                'Ngày công bố' => $trademark['publication_date'] ?? null,

                'Số bằng' => $trademark['registration_number'] ?? null,
                'Ngày cấp bằng' => $trademark['registration_date'] ?? null,
                'Ngày hết hạn' => $trademark['expiration_date'] ?? null,

                'Đại diện pháp luật' => $trademark['representative_name'] ?? null,
                'Địa chỉ đại diện' => $trademark['representative_address'] ?? null,

                'Trạng thái' => $trademark['status'] ?? null,
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
            'Màu nhãn hiệu',
            'Kiểu mẫu nhãn',
            'Phân loại hình',
            'Yếu tố loại trừ',
            'Chủ nhãn hiệu',
            'Địa chỉ',
            'Tên chủ khác',

            'Loại đơn',
            'Số đơn',
            'Ngày nộp đơn',

            'Số công bố',
            'Ngày công bố',

            'Số bằng',
            'Ngày cấp bằng',
            'Ngày hết hạn',

            'Đại diện pháp luật',
            'Địa chỉ đại diện',

            'Trạng thái',
        ];
    }
}
