<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
           Thống kê sáng chế toàn văn
        </span>
        <div class=" justify-between w-max ml-auto self-center">
            <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.geographical_indications.index') }}">
                Danh sách
            </a>
        </div>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 py-4">
            <!-- Form lọc -->
            @component('components.admin.filter-geographical', [
                'action' => route('admin.geographical_indications.index'),
                'ajaxRoute' => route('admin.geographical_indications.ajax_list'),
                'filters' => [
                    ['name' => 'issue_date', 'label' => 'Năm cấp', 'options' => $uniqueIssueYears],
                    ['name' => 'management_unit', 'label' => 'Đơn vị quản lý', 'options' => $uniqueManagementUnits],
                    ['name' => 'district_id', 'label' => 'Huyện', 'options' => $districts],
                    ['name' => 'commune_id', 'label' => 'Xã', 'options' => []],
                    
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
                <form id="exportFormExcel" action="{{ route('admin.geographical_indications.export_excel') }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="geographicalIndications" id="exportData">
                </form>
                
            </div>

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="geographical_indicationsList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.geographical_indications.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="geographical_indicationsListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.geographical_indications.ajax_export')
        </div>
    </div>

    @include('admin.geographical_indications.script_ajax_filter_export')

</x-admin-layout>
