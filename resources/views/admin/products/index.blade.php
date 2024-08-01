<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <span class="text-sm font-semibold">
            Danh sách sản phẩm
        </span>
        <div class=" items-center justify-between w-max ml-auto">
            <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.products.statistical') }}">
                <i class="fad fa-chart-line"></i> Thống kê
            </a>
            <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.products.create') }}">
                <i class="fad fa-plus-circle"></i>
            </a>
        </div>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 pb-3">
            <!-- Form lọc -->
            @component('components.admin.filter-product', [
                'action' => route('admin.products.index'),
                'ajaxRoute' => route('admin.products.ajax_list'),
                'filters' => [
                ],
            ])
            @endcomponent

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="productsList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.products.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="productsListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.products.ajax_export')
        </div>
    </div>

    @include('admin.products.script_ajax_filter_export')

</x-admin-layout>
