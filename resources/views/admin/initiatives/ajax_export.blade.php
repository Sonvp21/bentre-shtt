<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
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
        @foreach ($initiatives as $index => $initiative)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $initiative->name ?? null }}</td>
                <td>{{ $initiative->author ?? null}}</td>
                <td>{{ $initiative->owner ?? null}}</td>
                <td>{{ $initiative->address ?? null}}</td>
                <td>{{ $initiative->fields ?? null}}</td>
                <td>{{ $initiative->recognition_year ?? null}}</td>
                <td class="text-center">{!! $initiative->status_text !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
