<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách sáng kiến</title>
    
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
    <h1>Danh sách sáng kiến</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sáng kiến</th>
                <th>Tác giả</th>
                <th>Chủ sáng kiến</th>
                <th>Địa chỉ</th>
                <th>Lĩnh vực</th>
                <th>Năm công nhận</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($initiatives as $index => $initiative)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $initiative['name'] }}</td>
                    <td>{{ $initiative['author'] }}</td>
                    <td>{{ $initiative['owner'] }}</td>
                    <td>{{ $initiative['address'] }}</td>
                    <td>{{ $initiative['fields'] }}</td>
                    <td>{{ $initiative['recognition_year'] }}</td>
                    <td>{{ $initiative['status_text'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
