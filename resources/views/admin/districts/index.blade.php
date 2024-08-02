<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
            Danh sách Huyện
        </span>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 py-4">
            <!-- Form lọc -->
            @component('components.admin.filter', [
                'action' => route('admin.districts.index'),
                'ajaxRoute' => route('admin.districts.ajax_list'),
                'filters' => [
                    ['name' => 'name', 'label' => 'Tên Huyện', 'options' => $uniqueNames],
                    // ['name' => 'area', 'label' => 'Diện tích', 'options' => $uniqueAreas],
                    // ['name' => 'population', 'label' => 'Dân số', 'options' => $uniquePopulations],
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
                <form id="exportFormExcel" action="{{ route('admin.districts.export_excel') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="districts" id="exportData">
                </form>
            </div>

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="districtsList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.districts.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="districtsListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.districts.ajax_export')
        </div>
    </div>

    @include('admin.districts.script_ajax_filter_export')

</x-admin-layout>
