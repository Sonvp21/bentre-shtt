<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
            Danh sách sáng chế toàn văn
        </span>

        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 py-4">
            <!-- Form lọc -->
            @component('components.admin.filter-patent', [
                'action' => route('admin.patents.index'),
                'ajaxRoute' => route('admin.patents.ajax_list'),
                'filters' => [],
            ])
            @endcomponent

            <div class=" justify-between w-max ml-auto self-center">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.patents.statistical') }}">
                    <i class="fad fa-chart-line"></i> Thống kê
                </a>
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.patents.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="patentsList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.patents.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="patentsListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.patents.ajax_export')
        </div>
    </div>

    @include('admin.patents.script_ajax_filter_export')

</x-admin-layout>
