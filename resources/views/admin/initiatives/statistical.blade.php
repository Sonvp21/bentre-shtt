<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <span class="text-sm font-semibold">
           Thống kê sáng kiến
        </span>
        <div class=" items-center justify-between w-max ml-auto">
            <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.initiatives.index') }}">
                Danh sách
            </a>
        </div>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 pb-3">
            <!-- Form lọc -->
            @component('components.admin.filter-initiative', [
                'action' => route('admin.initiatives.index'),
                'ajaxRoute' => route('admin.initiatives.ajax_list'),
                'filters' => [
                    ['name' => 'recognition_year', 'label' => 'Năm công bố', 'options' => $uniqueRecognitionYears],
                    ['name' => 'status', 'label' => 'Trạng thái đơn', 'options' => $uniqueStatus],
                    ['name' => 'fields', 'label' => 'Lĩnh vực', 'options' => $uniqueFields],
                ],
            ])
            @endcomponent
            <!-- xuất excel, pdf -->
            <div
                class="ml-auto h-full flex flex-col md:flex-row self-center justify-self-center lg:items-center place-content-center">
                <div class="mx-2 group hover:text-teal-500">
                    <button type="button" id="exportButton" class="btn glass contents group-hover:text-teal-500">
                        <i class="fad fa-file-excel"></i>
                        Xuất Excel
                    </button>
                </div>
                <div class="mx-2 group hover:text-teal-500">
                    <button type="button" id="exportPdfButton" class="btn glass contents group-hover:text-teal-500">
                        <i class="fad fa-print"></i>
                            In
                    </button>
                </div>
                <form id="exportFormExcel" action="{{ route('admin.initiatives.export_excel') }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="initiatives" id="exportData">
                </form>
                
            </div>

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="initiativesList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.initiatives.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="initiativesListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.initiatives.ajax_export')
        </div>
    </div>

    @include('admin.initiatives.script_ajax_filter_export')

</x-admin-layout>
