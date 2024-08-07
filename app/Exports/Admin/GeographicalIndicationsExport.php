<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GeographicalIndicationsExport implements FromCollection, WithHeadings
{
    protected $geographicalIndications;

    public function __construct(array $geographicalIndications)
    {
        $this->geographicalIndications = $geographicalIndications;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng geographicalIndications thành collection để export
        $data = [];

        foreach ($this->geographicalIndications as $geographicalIndication) {
            $data[] = [
                'Huyện' => $geographicalIndication['district_name'] ?? null,
                'Xã' => $geographicalIndication['commune_name'] ?? null,
                'Tên sản phẩm' => $geographicalIndication['name'] ?? null,
                'Đơn vị quản lý' => $geographicalIndication['management_unit'] ?? null,
                'Số đơn' => $geographicalIndication['application_number'] ?? null,
                'Số văn bằng' => $geographicalIndication['certificate_number'] ?? null,
                'Ngày cấp' => $geographicalIndication['issue_date'] ?? null,
                'Nội dung' => $geographicalIndication['content'] ?? null,
                'Đơn vị uỷ quyền' => $geographicalIndication['authorized_unit'] ?? null,
                'Trạng thái' => $geographicalIndication['status'] ?? null,
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
            'Đơn vị quản lý',
            'Số đơn',
            'Số văn bằng',
            'Ngày cấp',
            'Nội dung',
            'Đơn vị uỷ quyền',
            'Trạng thái',
        ];
    }
}
