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

                'Số đơn gốc' => $IndustrialDesign['filing_number'] ?? null,
                'Ngày nộp đơn' => $IndustrialDesign['filing_date'] ?? null,

                'Số công bố' => $IndustrialDesign['publication_number'] ?? null,
                'Ngày công bố' => $IndustrialDesign['publication_date'] ?? null,

                'Số bằng' => $IndustrialDesign['registration_number'] ?? null,
                'Ngày cấp bằng' => $IndustrialDesign['registration_date'] ?? null,
                'Ngày hết hạn bằng' => $IndustrialDesign['expiration_date'] ?? null,


                'Người thiết kế' => $IndustrialDesign['designer'] ?? null,
                'Địa chỉ người thiết kế' => $IndustrialDesign['designer_address'] ?? null,

                'Đại diện pháp luật' => $IndustrialDesign['representative_name'] ?? null,
                'Địa chỉ đại diện pháp luật' => $IndustrialDesign['representative_address'] ?? null,

                'Phân loại locarno' => $IndustrialDesign['locarno_classes'] ?? null,

                'Trạng thái' => $IndustrialDesign['status'] ?? null,
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

            'Số công bố',
            'Ngày công bố',

            'Số bằng',
            'Ngày cấp bằng',
            'Ngày hết hạn bằng',

            'Người thiết kế',
            'Địa chỉ người thiết kế',

            'Đại diện pháp luật',
            'Địa chỉ đại diện pháp luật',

            'Phân loại locarno',

            'Trạng thái',
        ];
    }
}
