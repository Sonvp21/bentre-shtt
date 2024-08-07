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

            <th>Số công bố</th>
            <th>Ngày công bố</th>

            <th>Số bằng</th>
            <th>Ngày cấp bằng</th>
            <th>Ngày hết hạn bằng</th>

            <th>Người thiết kế</th>
            <th>Địa chỉ người thiết kế</th>

            <th>Đại diện pháp luật</th>
            <th>Địa chỉ đại diện pháp luật</th>

            <th>Phân loại locarno</th>
            
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

                <td>{{ $IndustrialDesign->filing_number ?? null }}</td>
                <td>{{ $IndustrialDesign->filing_date ?? null }}</td>
                
                <td>{!! $IndustrialDesign->publication_number ?? null !!}</td>
                <td>{{ $IndustrialDesign->publication_date ?? null }}</td>

                <td>{{ $IndustrialDesign->registration_number ?? null }}</td>
                <td>{{ $IndustrialDesign->registration_date ?? null }}</td>
                <td>{{ $IndustrialDesign->expiration_date ?? null }}</td>

                <td>{!! $IndustrialDesign->designer ?? null !!}</td>
                <td>{{ $IndustrialDesign->designer_address ?? null }}</td>

                <td>{{ $IndustrialDesign->representative_name ?? null }}</td>
                <td>{{ $IndustrialDesign->representative_address ?? null }}</td>

                <td>{{ $IndustrialDesign->locarno_classes ?? null }}</td>

                <td>{!! $IndustrialDesign->status ?? null !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
