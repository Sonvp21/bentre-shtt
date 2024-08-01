<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
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
        @foreach ($geographicalIndications as $index => $geographicalIndication)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $geographicalIndication->district->name ?? null }}</td>
                <td>{{ $geographicalIndication->commune->name ?? null }}</td>
                <td>{{ $geographicalIndication->name ?? null }}</td>
                <td>{{ $geographicalIndication->management_unit ?? null }}</td>
                <td>{{ $geographicalIndication->application_number ?? null }}</td>
                <td>{{ $geographicalIndication->certificate_number ?? null }}</td>
                <td class="text-center">{!! $geographicalIndication->content ?? null !!}</td>
                <td class="text-center">{{ $geographicalIndication->authorized_unit }}</td>
                <td>{{ $geographicalIndication->issue_date ?? null }}</td>
                <td>{{ $geographicalIndication->status ?? null }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
