<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Huyện</th>
            <th>Xã</th>
            <th>Nhóm ngành</th>
            <th>Tên nhãn hiệu</th>
            <th>Chủ nhãn hiệu</th>
            <th>Mô tả</th>
            <th>Địa chỉ</th>
            <th>Liên hệ</th>
            <th>Số đơn</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái đơn</th>
            <th>Số công bố</th>
            <th>Ngày công bố</th>
            <th>Ngày hết hạn</th>
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
                <td>{{ $trademark->owner ?? null}}</td>
                <td>{{ $trademark->description ?? null}}</td>
                <td>{{ $trademark->address ?? null}}</td>
                <td>{{ $trademark->contact ?? null}}</td>
                <td>{{ $trademark->legal_representative ?? null}}</td>
                <td>{{ $trademark->application_number ?? null}}</td>
                <td class="text-center">{{ $trademark->submission_date ?? null}}</td>
                <td class="text-center">{!! $trademark->submission_status_text !!}</td>
                <td>{{ $trademark->publication_number ?? null}}</td>
                <td>{{ $trademark->publication_date ?? null}}</td>
                <td>{{ $trademark->out_of_date ?? null}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
