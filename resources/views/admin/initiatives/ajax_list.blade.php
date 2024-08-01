<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Tên sáng kiến</th>
            <th>Tác giả</th>
            <th>Chủ sáng kiến</th>
            <th>Lĩnh vực</th>
            <th>Năm công nhận</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($initiatives as $index => $initiative)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $initiative->name }}</td>
                <td>{{ $initiative->author }}</td>
                <td>{{ $initiative->owner }}</td>
                <td>{{ $initiative->fields }}</td>
                <td class="text-center">{{ $initiative->recognition_year }}</td>
                <td class="text-center">{!! $initiative->status_text !!}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.initiatives.edit', $initiative) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $initiative->id }}"
                        action="{{ route('admin.initiatives.destroy', $initiative) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá sáng kiến này?')"
                            class="p-0">
                            <x-heroicon-o-trash class="size-4 text-red-500 cursor-pointer" />
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="p-3">
    {{ $initiatives->links('vendor.pagination.custom-pagination') }}
</div>
