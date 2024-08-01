<?php

namespace App\Exports\Admin;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InitiativesExport implements FromCollection, WithHeadings
{
    protected $initiatives;

    public function __construct(array $initiatives)
    {
        $this->initiatives = $initiatives;
    }

    public function collection()
    {
        // Chuyển đổi dữ liệu từ mảng initiatives thành collection để export
        $data = [];

        foreach ($this->initiatives as $initiative) {
            $data[] = [
                'Tên sáng kiến' => $initiative['name'] ?? null,
                'Tác giả' => $initiative['author'] ?? null,
                'Chủ sáng kiến' => $initiative['owner'] ?? null,
                'Địa chỉ' => $initiative['address'] ?? null,
                'Lĩnh vực' => $initiative['fields'] ?? null,
                'Năm công nhận' => $initiative['recognition_year'] ?? null,
                'Trạng thái' => $initiative['status_text'] ?? null,
            ];
        }

        return new Collection($data);
    }

    public function headings(): array
    {
        return [
            'Tên sáng kiến',
            'Tác giả',
            'Chủ sáng kiến',
            'Địa chỉ',
            'Lĩnh vực',
            'Năm công nhận',
            'Trạng thái',
        ];
    }
}
