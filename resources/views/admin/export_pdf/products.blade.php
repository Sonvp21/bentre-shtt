<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách sản phẩm</title>
    
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
    <h1>Danh sách sản phẩm</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Huyện</th>
                <th>Xã</th>
                <th>Tên sản phẩm</th>
                <th>Chủ sở hữu</th>
                <th>Đại diện pháp luật</th>
                <th>Địa chỉ</th>
                <th>Liên hệ</th>
                <th>Ngày đăng ký</th>
                <th>Ghi chú</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product['district_name'] }}</td>
                    <td>{{ $product['commune_name'] }}</td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['owner'] }}</td>
                    <td>{{ $product['representatives'] }}</td>
                    <td>{{ $product['address'] }}</td>
                    <td>{{ $product['contact'] }}</td>
                    <td>{{ $product['submission_date'] }}</td>
                    <td>{{ $product['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
