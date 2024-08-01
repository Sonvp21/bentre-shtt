<x-admin-layout>
    <link href="{{ asset('adminpage/table/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpage/table/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            text-transform: none;
        }
    </style>
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            <span class="flex items-center gap-2 text-sm font-semibold leading-tight text-gray-800">
                Danh sách hội đồng
            </span>
            <div class="flex ml-auto">
                <form action="{{ route('admin.technical_innovation_committees.index') }}" method="GET" class="w-full">
                    <div class="flex items-center justify-between">
                        <a class="flex btn" href="{{ route('admin.technical_innovation_committees.create') }}">
                            <i class="fad fa-plus-circle"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <x-admin.alerts.success />
        <div class="p-3 overflow-hidden text-sm bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <div id='recipients' class="bg-white rounded shadow lg:mt-0">
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th class="p-0">
                                    <input type="checkbox" id="checkAll" class="checkbox checkbox-accent" />
                                </th>
                                <th>STT</th>
                                <th>Tên hội đồng</th>
                                <th>Hồ sơ</th>
                                <th>Điểm số</th>
                                <th>Thời gian chấm</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technicalInnovationCommittees as $index => $technicalInnovationCommittee)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="checkbox checkbox-accent check-item" />
                                    </td>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $technicalInnovationCommittee->name }}</td>
                                    <td>{{ $technicalInnovationCommittee->dossier->name }}</td>
                                    <td class="text-center">{{ $technicalInnovationCommittee->score }}</td>
                                    <td class="text-center">{{ $technicalInnovationCommittee->date  }}</td>
                                    <td class="text-center">{{ $technicalInnovationCommittee->status }}</td>
                                    <td class="flex justify-around">
                                        <a href="{{ route('admin.technical_innovation_committees.edit', $technicalInnovationCommittee) }}" type="button"><i
                                                class="text-yellow-600 fa fa-edit"></i></a>
                                        <form id="delete-form-{{ $technicalInnovationCommittee->id }}"
                                            action="{{ route('admin.technical_innovation_committees.destroy', $technicalInnovationCommittee) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá vi phạm này?')"
                                                class="p-0">
                                                <x-heroicon-o-trash class="text-red-500 cursor-pointer size-4" />
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

</x-admin-layout>
