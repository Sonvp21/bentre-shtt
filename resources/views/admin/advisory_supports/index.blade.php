<x-admin-layout>
    <link href="{{ asset('adminpage/table/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpage/table/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            text-transform: none;
        }
    </style>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
                Danh sách thông tin hỗ trợ, tư vấn
            </span>
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight flex">
            
            <div class="flex ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.advisory_supports.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5 p-3 text-sm">
            <div class="overflow-x-auto">
                <div id='recipients' class="lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th class="p-0">
                                    <input type="checkbox" id="checkAll" class="checkbox checkbox-accent" />
                                </th>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>ngày đăng</th>
                                <th>Ghi chú</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advisorySupports as $index => $advisorySupport)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="checkbox checkbox-accent check-item" />
                                    </td>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $advisorySupport->title }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($advisorySupport->published_at)->format('d-m-Y') }}</td>
                                    <td>{{ $advisorySupport->status }}</td>
                                    <td class="flex justify-center">
                                        <a href="{{ route('admin.advisory_supports.edit', $advisorySupport) }}" class="mr-2"
                                            type="button"><i class="fa fa-edit text-yellow-600"></i></a>
                                        <form id="delete-form-{{ $advisorySupport->id }}"
                                            action="{{ route('admin.advisory_supports.destroy', $advisorySupport) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá thông tin này?')"
                                                class="p-0">
                                                <x-heroicon-o-trash class="size-4 text-red-500 cursor-pointer" />
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>
                <!--/Card-->
            </div>
        </div>
    </div>

    @pushOnce('bottom_scripts')
        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <!--Datatables -->
        <script src="{{ asset('adminpage/table/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminpage/table/js/dataTables.responsive.min.js') }}"></script>
        <script>
            $(document).ready(function() {

                var table = $('#example').DataTable({
                        responsive: true
                    })
                    .columns.adjust()
                    .responsive.recalc();
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const checkAll = document.getElementById('checkAll');
                const checkItems = document.querySelectorAll('.check-item');

                checkAll.addEventListener('change', function() {
                    checkItems.forEach(item => {
                        item.checked = checkAll.checked;
                    });
                });
            });
        </script>
    @endPushOnce
</x-admin-layout>
