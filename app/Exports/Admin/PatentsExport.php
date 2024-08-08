<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatentsExport implements FromCollection, WithHeadings
{
    protected $patents;

    public function __construct(array $patents)
    {
        $this->patents = $patents;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng patents thành collection để export
        $data = [];

        foreach ($this->patents as $patent) {
            $data[] = [
                'Huyện' => $patent['district_name'] ?? null,
                'Xã' => $patent['commune_name'] ?? null,
                'Lĩnh vực' => $patent['type_name'] ?? null,

                'Tên sáng chế' => $patent['title'] ?? null,
                'Phân loại IPC' => $patent['ipc_classes'] ?? null,
                'Chủ đơn' => $patent['applicant'] ?? null,
                'Địa chỉ chủ đơn' => $patent['applicant_address'] ?? null,
                'Tác giả' => $patent['inventor'] ?? null,
                'Địa chỉ tác giả' => $patent['inventor_address'] ?? null,
                'Tác giả khác' => $patent['other_inventor'] ?? null,
                'Địa chỉ tác giả khác' => $patent['abstract'] ?? null,

                'Loại đơn' => $patent['application_type'] ?? null,
                'Số đơn' => $patent['filing_number'] ?? null,
                'Ngày nộp đơn' => $patent['filing_date'] ?? null,

                'Số công bố' => $patent['publication_number'] ?? null,
                'Ngày công bố' => $patent['publication_date'] ?? null,

                'Số bằng' => $patent['registration_number'] ?? null,
                'Ngày cấp bằng' => $patent['registration_date'] ?? null,
                'Ngày hết hạn' => $patent['expiration_date'] ?? null,

                'Đại diện pháp luật' => $patent['representative_name'] ?? null,
                'Địa chỉ đại diện' => $patent['representative_address'] ?? null,

                'Trạng thái' => $patent['status'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Huyện',
            'Xã',
            'Lĩnh vực',

            'Tên sáng chế',
            'Phân loại IPC',
            'Chủ đơn',
            'Địa chỉ chủ đơn',
            'Tác giả',
            'Địa chỉ tác giả',
            'Tác giả khác',
            'Địa chỉ tác giả khác',

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
