<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách Nhãn hiệu</title>

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
    <h1>Danh sách nhãn hiệu</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Huyện</th>
                <th>Xã</th>
                <th>Nhóm ngành</th>

                <th>Tên nhãn hiệu</th>
                <th>Màu nhãn hiệu</th>
                <th>Kiểu mẫu nhãn</th>
                <th>Phân loại hình</th>
                <th>Yếu tố loại trừ</th>
                <th>Chủ nhãn hiệu</th>
                <th>Địa chỉ</th>
                <th>Tên chủ khác</th>

                <th>Loại đơn</th>
                <th>Số đơn</th>
                <th>Ngày nộp đơn</th>

                <th>Số công bố</th>
                <th>Ngày công bố</th>

                <th>Số bằng</th>
                <th>Ngày cấp bằng</th>
                <th>Ngày hết hạn</th>

                <th>Đại diện pháp luật</th>
                <th>Địa chỉ đại diện</th>

                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trademarks as $index => $trademark)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $trademark['district_name'] }}</td>
                    <td>{{ $trademark['commune_name'] }}</td>
                    <td>{{ $trademark['type_name'] }}</td>

                    <td>{{ $trademark['mark'] }}</td>
                    <td>{{ $trademark['mark_colors'] }}</td>
                    <td>{{ $trademark['mark_feature'] }}</td>
                    <td>{{ $trademark['vienna_classes'] }}</td>
                    <td>{{ $trademark['disclaimer'] }}</td>
                    <td>{{ $trademark['owner'] }}</td>
                    <td>{{ $trademark['address'] }}</td>
                    <td>{{ $trademark['other_owner'] }}</td>

                    <td>{{ $trademark['application_type'] }}</td>
                    <td>{{ $trademark['filing_number'] }}</td>
                    <td>{{ $trademark['filing_date'] }}</td>

                    <td>{{ $trademark['publication_number'] }}</td>
                    <td>{{ $trademark['publication_date'] }}</td>

                    <td>{{ $trademark['registration_number'] }}</td>
                    <td>{{ $trademark['registration_date'] }}</td>
                    <td>{{ $trademark['expiration_date'] }}</td>

                    <td>{{ $trademark['representative_name'] }}</td>
                    <td>{{ $trademark['representative_address'] }}</td>

                    <td>{{ $trademark['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
