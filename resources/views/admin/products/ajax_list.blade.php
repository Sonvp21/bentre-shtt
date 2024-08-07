<table class="table">
    <!-- head -->
    <thead>
        <tr class="text-sm">
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Chủ sở hữu</th>
            <th>Đại diện</th>
            <th>Thời gian đăng ký</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->owner }}</td>
                <td>{{ $product->representatives }}</td>
                <td class="text-center">{{ $product->submission_date }}</td>
                <td class="flex justify-around">
                    <a href="{{ route('admin.products.edit', $product) }}" type="button"><i
                            class="fa fa-edit text-yellow-600"></i></a>
                    <form id="delete-form-{{ $product->id }}" action="{{ route('admin.products.destroy', $product) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')"
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
    {{ $products->links('vendor.pagination.custom-pagination') }}
</div>
