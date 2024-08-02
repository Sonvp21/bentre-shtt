<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
           Thống kê bảo hộ nhãn hiệu
        </span>
        <div class=" justify-between w-max ml-auto self-center">
            <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.trademarks.index') }}">
                Danh sách
            </a>
        </div>
        <x-admin.alerts.success />

        <div class="grid grid-cols-3 gap-4 py-4">
            <!-- Form lọc -->
            @component('components.admin.filter-trademark', [
                'action' => route('admin.trademarks.index'),
                'ajaxRoute' => route('admin.trademarks.ajax_list'),
                'filters' => [
                    ['name' => 'publication_date', 'label' => 'Năm công bố', 'options' => $uniquePublicationYears],
                    ['name' => 'type_id', 'label' => 'Nhóm ngành', 'options' => $types],
                    ['name' => 'submission_status', 'label' => 'Trạng thái đơn', 'options' => $uniqueSubmissionStatus],
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
                <form id="exportFormExcel" action="{{ route('admin.trademarks.export_excel') }}" method="POST"
                    style="display: none;">
                    @csrf
                    <input type="hidden" name="trademarks" id="exportData">
                </form>
            </div>

        </div>
        <!-- Hiển thị danh sách kết quả -->
        <div id="trademarksList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.trademarks.ajax_list')
        </div>
        <!-- Ẩn danh sách hiển thị kết quả cho xuất file excel, pdf -->
        <div hidden id="trademarksListExport" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.trademarks.ajax_export')
        </div>
    </div>

    @include('admin.trademarks.script_ajax_filter_export')

</x-admin-layout>
