<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Huyện</th>
            <th>Xã</th>
            <th>Nhóm ngành</th>

            <th>Tên nhãn hiệu</th>
            <th>Màu nhãn hiệu</th>
            <th>Kiểu mẫu nhãn</th>
            <th>Phân loại hình</th>
            <th>Yếu tố loại trừ</th>
            <th>Chủ nhãn hiệu</th>
            <th>Địa chỉ</th>
            <th>Tên chủ khác</th>

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
        @foreach ($trademarks as $index => $trademark)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $trademark->district->name ?? null }}</td>
                <td>{{ $trademark->commune->name ?? null}}</td>
                <td>{{ $trademark->type->name ?? null}}</td>
                
                <td>{{ $trademark->mark ?? null}}</td>
                <td>{{ $trademark->mark_colors ?? null}}</td>
                <td>{{ $trademark->mark_feature ?? null}}</td>
                <td>{{ $trademark->vienna_classes ?? null}}</td>
                <td>{{ $trademark->disclaimer ?? null}}</td>
                <td>{{ $trademark->owner ?? null}}</td>
                <td>{{ $trademark->address ?? null}}</td>
                <td>{{ $trademark->other_owner ?? null}}</td>

                <td>{{ $trademark->application_type ?? null}}</td>
                <td>{{ $trademark->filing_number ?? null}}</td>
                <td>{{ $trademark->filing_date ?? null}}</td>

                <td>{{ $trademark->publication_number ?? null }}</td>
                <td>{{ $trademark->publication_date ?? null}}</td>

                <td>{{ $trademark->registration_number ?? null}}</td>
                <td>{{ $trademark->registration_date ?? null}}</td>
                <td>{{ $trademark->expiration_date ?? null}}</td>
                
                <td>{{ $trademark->representative_name ?? null}}</td>
                <td>{{ $trademark->representative_address ?? null}}</td>

                <td>{{ $trademark->status ?? null}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
