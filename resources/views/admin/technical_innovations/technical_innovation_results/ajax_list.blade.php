<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Tên hồ sơ</th>
            <th>Lĩnh vực</th>
            <th>Đơn vị</th>
            <th>Năm thi</th>
            <th>Xếp hạng</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $index => $technicalInnovationResult)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $technicalInnovationResult->dossier->name }}</td>
                <td>{{ $technicalInnovationResult->dossier->field }}</td>
                <td>{{ $technicalInnovationResult->dossier->unit_name }}</td>
                <td class="text-center">{{ $technicalInnovationResult->year }}</td>
                <td class="text-center">{{ $technicalInnovationResult->rank }}</td>
                <td class="text-center">{{ $technicalInnovationResult->status }}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.technical_innovation_results.edit', $technicalInnovationResult) }}" type="button">
                        <i class="text-yellow-600 fa fa-edit"></i>
                    </a>
                    <form id="delete-form-{{ $technicalInnovationResult->id }}" action="{{ route('admin.technical_innovation_results.destroy', $technicalInnovationResult) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá hồ sơ này?')" class="p-0">
                            <x-heroicon-o-trash class="text-red-500 cursor-pointer size-4" />
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="p-3">
    {{ $results->links('vendor.pagination.custom-pagination') }}
</div>
