<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn</th>
            <th>Lĩnh vực</th>
            <th>Sáng chế/Chủ đơn/Địa chỉ</th>
            <th>Hình ảnh</th>
            <th>Ngày công bố</th>
            <th>Trạng thái đơn</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patents as $index => $patent)
            <tr>
                <td class="text-center">{{ ($patents->currentPage() - 1) * $patents->perPage() + $loop->iteration }}</td>
                <td>{{ $patent->filing_number }}</td>
                <td>{{ $patent->type->name }}</td>
                <td>{{ $patent->title }}<br>
                    <span style="font-weight: 700">{{ $patent->applicant }}</span> <br>
                    {{ $patent->applicant_address }}
                </td>
                <td>
                    <div class="flex justify-center items-center">
                        @if ($patent->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $patent->images->first()->file_path) }}"
                                style="width: 50px; border-radius: 5px;" alt="{{ $patent->images->first()->file_name }}">
                        @else
                            <span>No image</span>
                        @endif
                    </div>
                </td>
                <td class="text-center">{{ $patent->publication_date }}</td>
                <td class="text-center">{!! $patent->status !!}</td>
                <td class="text-center">
                    <a href="{{ route('admin.patents.edit', $patent) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $patent->id }}" action="{{ route('admin.patents.destroy', $patent) }}"
                        method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá sáng chế này?')"
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
    {{ $patents->render('vendor.pagination.custom-pagination') }}
</div>
