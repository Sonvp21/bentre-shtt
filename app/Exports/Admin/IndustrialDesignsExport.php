<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IndustrialDesignsExport implements FromCollection, WithHeadings
{
    protected $IndustrialDesigns;

    public function __construct(array $IndustrialDesigns)
    {
        $this->IndustrialDesigns = $IndustrialDesigns;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng IndustrialDesigns thành collection để export
        $data = [];

        foreach ($this->IndustrialDesigns as $IndustrialDesign) {
            $data[] = [
                'Huyện' => $IndustrialDesign['district_name'] ?? null,
                'Xã' => $IndustrialDesign['commune_name'] ?? null,
                'Nhóm ngành' => $IndustrialDesign['type_name'] ?? null,
                'Tên kiểu dáng' => $IndustrialDesign['name'] ?? null,
                'Mô tả' => $IndustrialDesign['description'] ?? null,
                'Chủ sở hữu' => $IndustrialDesign['owner'] ?? null,
                'Địa chỉ' => $IndustrialDesign['address'] ?? null,

                'Số đơn gốc' => $IndustrialDesign['application_number'] ?? null,
                'Ngày nộp đơn' => $IndustrialDesign['submission_date'] ?? null,
                'Trạng thái đơn' => $IndustrialDesign['submission_status_text'] ?? null,

                'Ngày công bố' => $IndustrialDesign['publication_date'] ?? null,
                'Số công bố' => $IndustrialDesign['publication_number'] ?? null,

                'Ngày cấp' => $IndustrialDesign['design_date'] ?? null,
                'Ngày hết hạn' => $IndustrialDesign['design_out_of_date'] ?? null,
                'Trạng thái' => $IndustrialDesign['design_status_text'] ?? null,
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
            'Tên kiểu dáng',
            'Mô tả',
            'Chủ sở hữu',
            'Địa chỉ',

            'Số đơn gốc',
            'Ngày nộp đơn',
            'Trạng thái đơn',

            'Ngày công bố',
            'Số công bố',

            'Ngày cấp',
            'Ngày hết hạn',
            'Trạng thái',
        ];
    }
}
