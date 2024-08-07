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
        Danh sách danh mục thông tin tư vấn, hỗ trợ
        </span>
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight flex">
            <div class="flex ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.advisory_supports.categories.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5 p-3 text-sm">
            <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $category->title }}</td>
                            <td class="flex justify-around">
                                <a href="{{ route('admin.advisory_supports.categories.edit', $category) }}"
                                    type="button">
                                    <i class="fa fa-edit text-yellow-600"></i>
                                </a>
                                {{-- 
                                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.advisory_supports.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá thông tin này?')" class="p-0">
                                        <x-heroicon-o-trash class="size-4 text-red-500 cursor-pointer" />
                                    </button>
                                </form>
                                --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--Datatables -->
    <script src="{{ asset('adminpage/table/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminpage/table/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true
            }).columns.adjust().responsive.recalc();
        });
    </script>
</x-admin-layout>
