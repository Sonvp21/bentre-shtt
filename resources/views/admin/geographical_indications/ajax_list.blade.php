<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Số đơn</th>
            <th>Tên sản phẩm</th>
            <th>Đơn vị quản lý</th>
            {{-- <th>Số văn bằng</th> --}}
            <th>Đơn vị uỷ quyền</th>
            <th>Ngày cấp</th>
            <th>ghi chú</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($geographicalIndications as $index => $geographicalIndication)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $geographicalIndication->application_number }}</td>
                <td>{{ $geographicalIndication->name }}</td>
                <td>{{ $geographicalIndication->management_unit }}</td>
                {{-- <td>{{ $geographicalIndication->certificate_number }}</td> --}}
                <td>{{ $geographicalIndication->authorized_unit }}</td>
                <td class="text-center">{{ $geographicalIndication->issue_date }}</td>
                <td class="text-center">{{ $geographicalIndication->status }}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.geographical_indications.edit', $geographicalIndication) }}"
                        type="button"><i class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $geographicalIndication->id }}"
                        action="{{ route('admin.geographical_indications.destroy', $geographicalIndication) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá CDDL này?')"
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
    {{ $geographicalIndications->links('vendor.pagination.custom-pagination') }}
</div>
