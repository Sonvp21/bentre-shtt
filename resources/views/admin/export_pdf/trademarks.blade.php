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
                <th>Chủ nhãn hiệu</th>
                <th>Mô tả</th>
                <th>Địa chỉ</th>
                <th>Liên hệ</th>
                <th>Số đơn</th>
                <th>Ngày nộp đơn</th>
                <th>Trạng thái đơn</th>
                <th>Số công bố</th>
                <th>Ngày công bố</th>
                <th>Ngày hết hạn</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trademarks as $index => $trademark)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $trademark['district_name'] }}</td>
                    <td>{{ $trademark['commune_name'] }}</td>
                    <td>{{ $trademark['type_name'] }}</td>
                    <td>{{ $trademark['name'] }}</td>
                    <td>{{ $trademark['owner'] }}</td>
                    <td>{{ $trademark['description'] }}</td>
                    <td>{{ $trademark['address'] }}</td>
                    <td>{{ $trademark['contact'] }}</td>
                    <td>{{ $trademark['application_number'] }}</td>
                    <td>{{ $trademark['submission_date'] }}</td>
                    <td>{{ $trademark['submission_status_text'] }}</td>
                    <td>{{ $trademark['publication_number'] }}</td>
                    <td>{{ $trademark['publication_date'] }}</td>
                    <td>{{ $trademark['out_of_date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
