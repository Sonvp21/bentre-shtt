<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn</th>
            <th>Nhóm ngành</th>
            <th>Tên nhãn hiệu</th>
            <th>Chủ nhãn hiệu</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trademarks as $index => $trademark)
            <tr>
                <td class="text-center">{{ ($trademarks->currentPage() - 1) * $trademarks->perPage() + $loop->iteration }}</td>
                <td>{{ $trademark->filing_number }}</td>
                <td>{{ $trademark->type->name ?? '' }}</td>
                <td>{{ $trademark->mark }}</td>
                <td>{{ $trademark->owner }}</td>
                <td class="text-center">{{ $trademark->filing_date }}</td>
                <td class="text-center">{{ $trademark->status }}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.trademarks.edit', $trademark) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $trademark->id }}"
                        action="{{ route('admin.trademarks.destroy', $trademark) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá nhãn hiệu này?')"
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
    {{ $trademarks->links('vendor.pagination.custom-pagination') }}
</div>
