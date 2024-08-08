<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Huyện</th>
            <th>Xã</th>
            <th>Lĩnh vực</th>

            <th>Tên sáng chế</th>
            <th>Phân loại IPC</th>
            <th>Chủ đơn</th>
            <th>Địa chỉ chủ đơn</th>
            <th>Tác giả</th>
            <th>Địa chỉ tác giả</th>
            <th>Tác giả khác</th>
            <th>Địa chỉ tác giả khác</th>

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
        @foreach ($patents as $index => $patent)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $patent->district->name ?? null }}</td>
                <td>{{ $patent->commune->name ?? null}}</td>
                <td>{{ $patent->type->name ?? null}}</td>
                
                <td>{{ $patent->title ?? null}}</td>
                <td>{{ $patent->ipc_classes ?? null}}</td>
                <td>{{ $patent->applicant ?? null}}</td>
                <td>{{ $patent->applicant_address ?? null}}</td>
                <td>{{ $patent->inventor ?? null}}</td>
                <td>{{ $patent->inventor_address ?? null}}</td>
                <td>{{ $patent->other_inventor ?? null}}</td>
                <td>{{ $patent->abstract ?? null}}</td>

                <td>{{ $patent->application_type ?? null}}</td>
                <td>{{ $patent->filing_number ?? null}}</td>
                <td>{{ $patent->filing_date ?? null}}</td>

                <td>{{ $patent->publication_number ?? null }}</td>
                <td>{{ $patent->publication_date ?? null}}</td>

                <td>{{ $patent->registration_number ?? null}}</td>
                <td>{{ $patent->registration_date ?? null}}</td>
                <td>{{ $patent->expiration_date ?? null}}</td>
                
                <td>{{ $patent->representative_name ?? null}}</td>
                <td>{{ $patent->representative_address ?? null}}</td>

                <td>{{ $patent->status ?? null}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
