<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn</th>
            <th>Nhóm ngành</th>
            <th>Tên kiểu dáng</th>
            <th>Chủ kiểu dáng</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái đơn</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($IndustrialDesigns as $index => $IndustrialDesign)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $IndustrialDesign->application_number }}</td>
                <td>{{ $IndustrialDesign->type->name ?? '' }}</td>
                <td>{{ $IndustrialDesign->name }}</td>
                <td>{{ $IndustrialDesign->owner }}</td>
                <td>{{ $IndustrialDesign->submissionAtVi }}</td>
                <td class="text-center">{!! $IndustrialDesign->submission_status_text !!}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.industrial_designs.edit', $IndustrialDesign) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $IndustrialDesign->id }}"
                        action="{{ route('admin.industrial_designs.destroy', $IndustrialDesign) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá kiểu dáng này?')"
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
    {{ $IndustrialDesigns->links('vendor.pagination.custom-pagination') }}
</div>
