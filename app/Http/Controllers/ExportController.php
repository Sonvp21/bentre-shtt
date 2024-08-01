<?php

namespace App\Http\Controllers;

use App\Models\Apply;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends Controller
{
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Đặt tên các cột
        $sheet->setCellValue('A1', 'Họ tên');
        $sheet->setCellValue('B1', 'Số điện thoại');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Trường học');
        $sheet->setCellValue('E1', 'Ngành');
        $sheet->setCellValue('F1', 'Thông tin cần tư vấn');

        // Lấy dữ liệu từ cơ sở dữ liệu
        $applies = Apply::all();
        $row = 2; // Bắt đầu từ hàng thứ 2 trong Excel

        // Điền dữ liệu vào từng hàng
        foreach ($applies as $apply) {
            $sheet->setCellValue('A'.$row, $apply->name);
            $sheet->setCellValue('B'.$row, $apply->phone);
            $sheet->setCellValue('C'.$row, $apply->email);
            $sheet->setCellValue('D'.$row, $apply->school);
            $sheet->setCellValue('E'.$row, $apply->major);
            $sheet->setCellValue('F'.$row, $apply->question);
            $row++;
        }

        // Tạo writer để viết file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'AppliesData.xlsx';
        $writer->save($fileName);

        // Tải file xuống
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
