<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Mã</th>
            <th>Tên Sáng chế</th>
            <th>Đại diện pháp luật</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái đơn</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patents as $index => $patent)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $patent->code }}</td>
            <td>{{ $patent->name }}</td>
            <td>{{ $patent->legal_representative }}</td>
            <td class="text-center">{{ $patent->submission_date }}</td>
            <td class="text-center">{!! $patent->submission_status_text !!}</td>
            <td class="flex justify-around">
                <a href="{{ route('admin.patents.edit', $patent) }}" type="button"><i
                        class="fa fa-edit text-yellow-600"></i></a>
                <form id="delete-form-{{ $patent->id }}"
                    action="{{ route('admin.patents.destroy', $patent) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Bạn có chắc muốn xoá sáng chế này?')"
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
    {{ $patents->links('vendor.pagination.custom-pagination') }}
</div>
