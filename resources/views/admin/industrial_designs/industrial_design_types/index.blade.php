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
            Danh sách nhóm ngành
        </span>
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight flex">
            <div class="flex ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.industrial_design_types.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5 p-3 text-sm">
            <div class="overflow-x-auto">
                <div id='recipients' class="lg:mt-0 rounded shadow bg-white">
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhóm ngành</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($industrialDesignType as $index => $DesignType)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $DesignType->name }}</td>

                                    <td class="flex justify-around">
                                        <a href="{{ route('admin.industrial_design_types.edit', $DesignType) }}"
                                            type="button"><i class="fa fa-edit text-yellow-600"></i></a>
                                        <form id="delete-form-{{ $DesignType->id }}"
                                            action="{{ route('admin.industrial_design_types.destroy', $DesignType) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá nhóm ngành này?')"
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
    @endPushOnce
</x-admin-layout>
