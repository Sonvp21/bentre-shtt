<x-admin-layout>
    <link href="{{ asset('adminpage/table/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpage/table/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            text-transform: none;
        }
    </style>
    <div class="flex-grow w-full p-5">
        <div class="text-gray-800 text-sm font-semibold leading-tight flex">
            <span class="text-gray-800 text-sm flex items-center gap-2 font-semibold leading-tight">
                Danh sách Hồ sơ sáng kiến
            </span>
            <div class="flex ml-auto">
                <form action="{{ route('admin.initiative_dossiers.index') }}" method="GET" class="w-full">
                    <div class="flex items-center justify-between">
                        <a class="btn flex" href="{{ route('admin.initiative_dossiers.create') }}">
                            <i class="fad fa-plus-circle"></i>
                        </a>
                    </div>
                </form>
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
                                <th>Tên Hồ sơ</th>
                                <th>Sáng kiến</th>
                                <th>Ngày nộp</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($initiativeDossiers as $index => $initiativeDossier)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $initiativeDossier->name }}</td>
                                    <td>{{ $initiativeDossier->initiative->name }}</td>
                                    <td class="text-center">{{ $initiativeDossier->submissionAtVi }}</td>
                                    <td class="text-center">{!! $initiativeDossier->submission_status_text !!}</td>
                                    <td class="flex justify-around">
                                        <a href="{{ route('admin.initiative_dossiers.edit', $initiativeDossier) }}"
                                            type="button"><i class="fa fa-edit text-yellow-600"></i></a>
                                        <form id="delete-form-{{ $initiativeDossier->id }}"
                                            action="{{ route('admin.initiative_dossiers.destroy', $initiativeDossier) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá Hồ sơ sáng kiến này?')"
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

</x-admin-layout>
