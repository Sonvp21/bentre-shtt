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
                'Mã' => $patent['code'] ?? null,
                'Tên sáng chế' => $patent['name'] ?? null,
                'Đại diện pháp luật' => $patent['legal_representative'] ?? null,
                'Số đơn' => $patent['application_number'] ?? null,
                'Ngày nộp đơn' => $patent['submission_date'] ?? null,
                'Trạng thái đơn' => $patent['submission_status_text'] ?? null,
                'Ngày công bố' => $patent['publication_date'] ?? null,
                'Số bằng' => $patent['number_patent'] ?? null,
                'Ngày cấp bằng' => $patent['patent_date'] ?? null,
                'Ngày hết hạn bằng' => $patent['patent_out_of_date'] ?? null,
                'Trạng thái bằng' => $patent['patent_status_text'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Huyện',
            'Xã',
            'Mã',
            'Tên sáng chế',
            'Đại diện pháp luật',
            'Số đơn',
            'Ngày nộp đơn',
            'Trạng thái đơn',
            'Ngày công bố',
            'Số bằng',
            'Ngày cấp bằng',
            'Ngày hết hạn bằng',
            'Trạng thái bằng',
        ];
    }
}
