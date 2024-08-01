<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Huyện</th>
            <th>Xã</th>
            <th>Nhóm ngành</th>
            <th>Tên Kiểu dáng</th>
            <th>Mô tả</th>
            <th>Chủ sở hữu</th>
            <th>Địa chỉ</th>

            <th>Số đơn gốc</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái đơn</th>

            <th>Ngày công bố</th>
            <th>Số công bố</th>

            <th>Ngày cấp</th>
            <th>Ngày hết hạn</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($IndustrialDesigns as $index => $IndustrialDesign)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $IndustrialDesign->district->name ?? null }}</td>
                <td>{{ $IndustrialDesign->commune->name ?? null }}</td>
                <td>{{ $IndustrialDesign->type->name ?? null }}</td>
                <td>{{ $IndustrialDesign->name ?? null }}</td>
                <td>{{ $IndustrialDesign->description ?? null }}</td>
                <td>{{ $IndustrialDesign->owner ?? null }}</td>
                <td>{{ $IndustrialDesign->address ?? null }}</td>

                <td>{{ $IndustrialDesign->application_number ?? null }}</td>
                <td>{{ $IndustrialDesign->submission_date ?? null }}</td>
                <td>{!! $IndustrialDesign->submission_status_text ?? null !!}</td>

                <td>{{ $IndustrialDesign->publication_date ?? null }}</td>
                <td>{{ $IndustrialDesign->publication_number ?? null }}</td>

                <td>{{ $IndustrialDesign->design_date ?? null }}</td>
                <td>{{ $IndustrialDesign->design_out_of_date ?? null }}</td>
                <td>{!! $IndustrialDesign->design_status_text ?? null !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
