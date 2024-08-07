<x-admin-layout>
    <!--Regular Datatables CSS-->
    <link href="{{ asset('adminpage/table/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="{{ asset('adminpage/table/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            text-transform: none;
        }
    </style>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
            Danh sách tài khoản
        </span>
        <div class="breadcrumbs text-sm">
            <div class="flex ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9 ml-auto" href="{{ route('admin.users.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
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
                                <th>Họ và tên</th>
                                {{-- <th>Nhóm thành viên</th> --}}
                                <th>Vai trò</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="checkbox checkbox-accent check-item" />
                                    </td>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $user->name }} {{ $user->fullname }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->display_name }}
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $user->category->name ?? 'No category' }}</td> --}}
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td class="text-center">
                                        {!! $user->status_label !!}
                                    </td>
                                    <td class="flex justify-around">
                                        <a href="{{ route('admin.users.edit', $user) }}" type="button"><i
                                                class="text-yellow-600 fa fa-edit"></i></a>
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá tài khoản này?')"
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
