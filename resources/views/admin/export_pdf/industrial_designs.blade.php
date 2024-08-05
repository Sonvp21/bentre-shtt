<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách Kiểu dáng công nghiệp</title>

    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            /* Giảm kích thước phông chữ */
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 4px;
            /* Giảm độ đệm */
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h1>Danh sách Kiểu dáng công nghiệp</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Huyện</th>
                <th>Xã</th>
                <th>Nhóm ngành</th>
                <th>Tên Kiểu dáng</th>
                <th>Mô tả</th>
                <th>Chủ sở hữu</th>
                <th>Địa chỉ</th>

                <th>Số đơn gốc</th>
                <th>Ngày nộp đơn</th>

                <th>Số công bố</th>
                <th>Ngày công bố</th>

                <th>Số bằng</th>
                <th>Ngày cấp bằng</th>
                <th>Ngày hết hạn bằng</th>

                <th>Người thiết kế</th>
                <th>Địa chỉ người thiết kế</th>

                <th>Đại diện pháp luật</th>
                <th>Địa chỉ đại diện pháp luật</th>

                <th>Phân loại locarno</th>
                
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($IndustrialDesigns as $index => $IndustrialDesign)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $IndustrialDesign['district_name'] }}</td>
                    <td>{{ $IndustrialDesign['commune_name'] }}</td>
                    <td>{{ $IndustrialDesign['type_name'] }}</td>
                    <td>{{ $IndustrialDesign['name'] }}</td>
                    <td>{{ $IndustrialDesign['description'] }}</td>
                    <td>{{ $IndustrialDesign['owner'] }}</td>
                    <td>{{ $IndustrialDesign['address'] }}</td>

                    <td>{{ $IndustrialDesign['filing_number'] }}</td>
                    <td>{{ $IndustrialDesign['filing_date'] }}</td>
                    <td>{{ $IndustrialDesign['publication_number'] }}</td>

                    <td>{{ $IndustrialDesign['publication_date'] }}</td>
                    <td>{{ $IndustrialDesign['registration_number'] }}</td>

                    <td>{{ $IndustrialDesign['registration_date'] }}</td>
                    <td>{{ $IndustrialDesign['expiration_date'] }}</td>
                    
                    <td>{{ $IndustrialDesign['designer'] }}</td>
                    <td>{{ $IndustrialDesign['designer_address'] }}</td>

                    <td>{{ $IndustrialDesign['representative_name'] }}</td>
                    <td>{{ $IndustrialDesign['representative_address'] }}</td>

                    <td>{{ $IndustrialDesign['locarno_classes'] }}</td>

                    <td>{{ $IndustrialDesign['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
