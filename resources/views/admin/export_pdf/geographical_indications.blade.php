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
                <th>Tên sản phẩm</th>
                <th>Đơn vị quản lý</th>
                <th>Số đơn</th>
                <th>Số văn bằng</th>
                <th>Nội dung</th>
                <th>Đơn vị uỷ quyền</th>
                <th>Ngày cấp</th>
                <th>ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($geographicalIndications as $index => $geographicalIndication)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $geographicalIndication['district_name'] }}</td>
                    <td>{{ $geographicalIndication['commune_name'] }}</td>
                    <td>{{ $geographicalIndication['name'] }}</td>
                    <td>{{ $geographicalIndication['management_unit'] }}</td>
                    <td>{{ $geographicalIndication['application_number'] }}</td>
                    <td>{{ $geographicalIndication['certificate_number'] }}</td>
                    <td>{!! $geographicalIndication['content'] !!}</td>
                    <td>{{ $geographicalIndication['authorized_unit'] }}</td>
                    <td>{{ $geographicalIndication['issue_date'] }}</td>
                    <td>{{ $geographicalIndication['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
