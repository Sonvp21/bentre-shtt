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
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            <span class="flex items-center gap-2 text-sm font-semibold leading-tight text-gray-800">
                Danh sách câu hỏi
            </span>
            <div class=" items-center justify-between w-max ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.questions.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
        </div>
        <x-admin.alerts.success />
        <div class="p-3 overflow-hidden text-sm bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <div id='recipients' class="bg-white rounded shadow lg:mt-0">
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em; padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Tên người gửi</th>
                                <th>Email</th>
                                <th>Thời gian gửi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $index => $question)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td>{{ $question->name_sender }}</td>
                                    <td>{{ $question->email }}</td>
                                    <td class="text-center">{{ $question->questionDateAtVi }}</td>
                                    <td>
                                        <span class="{{ $question->status == 1 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $question->status == 1 ? 'Phê duyệt' : 'Chưa phê duyệt' }}
                                        </span>
                                    </td>
                                    <td class="flex justify-around">
                                        <a class="cursor-pointer" data-title="{{ $question->title }}"
                                            data-content="{!! $question->content !!}"
                                            data-name_sender="{{ $question->name_sender }}"
                                            data-email="{{ $question->email }}" data-status="{{ $question->status }}"
                                            onclick="showModal(this)">
                                            <i class="fad fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.questions.edit', $question) }}" type="button"><i
                                                class="text-yellow-600 fa fa-edit"></i></a>
                                        <form id="delete-form-{{ $question->id }}"
                                            action="{{ route('admin.questions.destroy', $question) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Bạn có chắc muốn xoá câu hỏi này?')"
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
    <!-- Open the modal using ID.showModal() method -->

    <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <div class="items-start justify-start ">
                <form method="dialog">
                    <h3 class="text-lg font-bold" id="modal-title"></h3>
                    <div class="flex items-center"><strong>Nội dung:</strong> <span id="modal-content"></span></div>
                    <div><strong>Tên người gửi:</strong> <span id="modal-name-sender"></span></div>
                    <div><strong>Email:</strong> <span id="modal-email"></span></div>
                    <div><strong>Trạng thái:</strong> <span id="modal-status"></span></div>
                    <button class="btn float-end">Close</button>
                </form>
            </div>
        </div>
    </dialog>
    @pushOnce('scripts')
        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <!--Datatables -->
        <script src="{{ asset('adminpage/table/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminpage/table/js/dataTables.responsive.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    responsive: true
                }).columns.adjust().responsive.recalc();
            });

            document.addEventListener('DOMContentLoaded', function() {
                const checkAll = document.getElementById('checkAll');
                const checkItems = document.querySelectorAll('.check-item');

                checkAll.addEventListener('change', function() {
                    checkItems.forEach(item => {
                        item.checked = checkAll.checked;
                    });
                });
            });

            function showModal(element) {
                document.getElementById('modal-title').innerText = element.getAttribute('data-title');
                document.getElementById('modal-content').innerHTML = element.getAttribute('data-content');
                document.getElementById('modal-name-sender').innerText = element.getAttribute('data-name_sender');
                document.getElementById('modal-email').innerText = element.getAttribute('data-email');
                document.getElementById('modal-status').innerText = element.getAttribute('data-status');
                document.getElementById('my_modal_5').showModal();
            }
        </script>
    @endPushOnce

</x-admin-layout>
