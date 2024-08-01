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
            font-size: 10px; /* Giảm kích thước phông chữ */
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
                <th>Mã</th>
                <th>Tên sáng chế</th>
                <th>Đại diện pháp luật</th>
                <th>Số đơn</th>
                <th>Ngày nộp đơn</th>
                <th>Trạng thái đơn</th>
                <th>Ngày công bố</th>
                <th>Số bằng</th>
                <th>Ngày cấp bằng</th>
                <th>Ngày hết hạn bằng</th>
                <th>Trạng thái bằng</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patents as $index => $patent)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $patent['district_name'] }}</td>
                    <td>{{ $patent['commune_name'] }}</td>
                    <td>{{ $patent['code'] }}</td>
                    <td>{{ $patent['name'] }}</td>
                    <td>{{ $patent['legal_representative'] }}</td>
                    <td>{{ $patent['application_number'] }}</td>
                    <td>{{ $patent['submission_date'] }}</td>
                    <td>{{ $patent['submission_status_text'] }}</td>
                    <td>{{ $patent['publication_date'] }}</td>
                    <td>{{ $patent['number_patent'] }}</td>
                    <td>{{ $patent['patent_date'] }}</td>
                    <td>{{ $patent['patent_out_of_date'] }}</td>
                    <td>{{ $patent['patent_status_text'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
