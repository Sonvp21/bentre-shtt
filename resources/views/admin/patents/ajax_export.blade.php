<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Huyện</th>
            <th>Xã</th>
            <th>Mã</th>
            <th>Tên sáng chế</th>
            <th>Đại diện pháp luật</th>
            <th>Số đơn</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái đơn</th>
            <th>Ngày công bố</th>
            <th>Số bằng</th>
            <th>Ngày cấp bằng</th>
            <th>Ngày hết hạn bằng</th>
            <th>Trạng thái bằng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patents as $index => $patent)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $patent->district->name ?? null }}</td>
                <td>{{ $patent->commune->name ?? null}}</td>
                <td>{{ $patent->code ?? null}}</td>
                <td>{{ $patent->name ?? null}}</td>
                <td>{{ $patent->legal_representative ?? null}}</td>
                <td>{{ $patent->application_number ?? null}}</td>
                <td class="text-center">{{ $patent->submission_date ?? null}}</td>
                <td class="text-center">{!! $patent->submission_status_text !!}</td>
                <td>{{ $patent->publication_date ?? null}}</td>
                <td>{{ $patent->number_patent ?? null}}</td>
                <td>{{ $patent->patent_date ?? null}}</td>
                <td>{{ $patent->patent_out_of_date ?? null}}</td>
                <td class="text-center">{!! $patent->patent_status_text !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
