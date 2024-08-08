<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách sáng chế</title>
    
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px; /* Giảm kích thước phông chữ */
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 4px; /* Giảm độ đệm */
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
    <h1>Danh sách sáng chế</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Huyện</th>
                <th>Xã</th>
                <th>Lĩnh vực</th>

                <th>Tên sáng chế</th>
                <th>Phân loại IPC</th>
                <th>Chủ đơn</th>
                <th>Địa chỉ chủ đơn</th>
                <th>Tác giả</th>
                <th>Địa chỉ tác giả</th>
                <th>Tác giả khác</th>
                <th>Địa chỉ tác giả khác</th>

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
            @foreach ($patents as $index => $patent)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patent['district_name'] }}</td>
                    <td>{{ $patent['commune_name'] }}</td>
                    <td>{{ $patent['type_name'] }}</td>

                    <td>{{ $patent['title'] }}</td>
                    <td>{{ $patent['ipc_classes'] }}</td>
                    <td>{{ $patent['applicant'] }}</td>
                    <td>{{ $patent['applicant_address'] }}</td>
                    <td>{{ $patent['inventor'] }}</td>
                    <td>{{ $patent['inventor_address'] }}</td>
                    <td>{{ $patent['other_inventor'] }}</td>
                    <td>{{ $patent['abstract'] }}</td>

                    <td>{{ $patent['application_type'] }}</td>
                    <td>{{ $patent['filing_number'] }}</td>
                    <td>{{ $patent['filing_date'] }}</td>

                    <td>{{ $patent['publication_number'] }}</td>
                    <td>{{ $patent['publication_date'] }}</td>

                    <td>{{ $patent['registration_number'] }}</td>
                    <td>{{ $patent['registration_date'] }}</td>
                    <td>{{ $patent['expiration_date'] }}</td>

                    <td>{{ $patent['representative_name'] }}</td>
                    <td>{{ $patent['representative_address'] }}</td>

                    <td>{{ $patent['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
