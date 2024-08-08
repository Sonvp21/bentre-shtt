<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn</th>
            <th>Nhóm ngành</th>
            <th>Tên nhãn hiệu/ Chủ đơn/Địa chỉ</th>
            <th>Hình ảnh</th>
            <th>Ngày nộp đơn</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($trademarks as $index => $trademark)
            <tr>
                <td class="text-center">
                    {{ ($trademarks->currentPage() - 1) * $trademarks->perPage() + $loop->iteration }}</td>
                <td>{{ $trademark->filing_number }}</td>
                <td>{{ $trademark->type->name ?? '' }}</td>
                <td>{{ $trademark->mark }}<br>
                    <span style="font-weight: 700">{{ $trademark->owner }}</span> <br>
                    {{ $trademark->address }}
                </td>
                <td>
                    <div class="flex justify-center items-center">
                        @if ($trademark->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $trademark->images->first()->file_path) }}"
                                style="width: 50px; border-radius: 5px;"
                                alt="{{ $trademark->images->first()->file_name }}">
                        @else
                            <span>No image</span>
                        @endif
                    </div>
                </td>
                <td class="text-center">{{ $trademark->filing_date }}</td>
                <td class="text-center">{{ $trademark->status }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.trademarks.edit', $trademark) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $trademark->id }}" class="mt-3"
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
