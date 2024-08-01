<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <span class="text-sm font-semibold">
            Danh sách Xã
        </span>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 pb-3">
            <!-- Form lọc -->
            @component('components.admin.filter-commune', [
                'action' => route('admin.communes.index'),
                'ajaxRoute' => route('admin.communes.ajax_list'),
                'filters' => [
                    ['name' => 'district_id', 'label' => 'Tên Huyện', 'options' => $districts],
                    ['name' => 'updated_year', 'label' => 'Năm cập nhật', 'options' => $uniqueUpdatedYears],
                ],
            ])
            @endcomponent
            <!-- xuất excel, pdf -->
            <div class="h-full flex flex-col md:flex-row self-center justify-self-center lg:items-center place-content-center">
                <div class="mx-2 group hover:text-teal-500">
                    <button type="button" id="exportButton" class="btn glass contents group-hover:text-teal-500">
                        <i class="fad fa-file-excel"></i>
                        Xuất Excel
                    </button>
                </div>
                <div class="mx-2 group hover:text-teal-500">
                    <button type="button" id="exportPdfButton" class="btn glass contents group-hover:text-teal-500">
                        <i class="fad fa-file-pdf"></i>
                        Xuất PDF
                    </button>
                </div>
                <form id="exportFormExcel" action="{{ route('admin.communes.export_excel') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="communes" id="exportData">
                </form>
            </div>

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="communesList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.communes.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="communesListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.communes.ajax_export')
        </div>
    </div>

    @include('admin.communes.script_ajax_filter_export')

</x-admin-layout>
