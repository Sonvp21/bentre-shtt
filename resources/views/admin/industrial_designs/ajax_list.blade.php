<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn gốc</th>
            <th>Nhóm ngành</th>
            <th>Tên kiểu dáng</th>
            <th>Hình ảnh</th>
            <th>Ngày công bố</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($IndustrialDesigns as $index => $IndustrialDesign)
            <tr>
                <td class="text-center">
                    {{ ($IndustrialDesigns->currentPage() - 1) * $IndustrialDesigns->perPage() + $loop->iteration }}
                </td>
                <td>{{ $IndustrialDesign->filing_number }}</td>
                <td class="text-justify">{{ $IndustrialDesign->type->name ?? '' }}</td>
                <td class="text-justify">{{ $IndustrialDesign->name }} <br>
                    <span style="font-weight: 700">{{ $IndustrialDesign->owner }}</span> <br>
                    {{ $IndustrialDesign->address }}
                </td>
                <td><div class="flex justify-center items-center">
                    @if($IndustrialDesign->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $IndustrialDesign->images->first()->file_path) }}"
                            style="width: 50px; border-radius: 5px;"
                            alt="{{ $IndustrialDesign->images->first()->file_name }}">
                    @else
                        <span>No image</span>
                    @endif
                </div></td>
                <td>{{ $IndustrialDesign->publication_date }}</td>
                <td class="text-center">{!! $IndustrialDesign->status !!}</td>
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
