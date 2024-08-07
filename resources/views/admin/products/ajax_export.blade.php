<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
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
        @foreach ($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->district->name ?? null }}</td>
                <td>{{ $product->commune->name ?? null}}</td>
                <td>{{ $product->name ?? null}}</td>
                <td>{{ $product->owner ?? null}}</td>
                <td>{{ $product->representatives ?? null}}</td>
                <td>{{ $product->address ?? null}}</td>
                <td>{{ $product->contact ?? null}}</td>
                <td class="text-center">{{ $product->submission_date ?? null}}</td>
                <td>{{ $product->status ?? null}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
