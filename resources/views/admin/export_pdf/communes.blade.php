<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Danh sách Xã</title>
    
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Danh sách Xã</h1>
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên xã</th>
                <th>Tên Huyện</th>
                <th>Diện tích</th>
                <th>Dân số</th>
                <th>Năm cập nhật</th>
            </tr>
        </thead>
        <tbody>
            @foreach($communes as $index => $commune)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $commune['name'] }}</td>
                    <td>{{ $commune['district_name'] }}</td>
                    <td>{{ $commune['area'] }}</td>
                    <td>{{ $commune['population'] }}</td>
                    <td>{{ $commune['updated_year'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
