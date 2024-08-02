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
                Danh sách câu trả lời
            </span>
            <div class=" items-center justify-between w-max ml-auto">
                <a class="btn btn-outline btn-accent !min-h-9 h-9" href="{{ route('admin.answers.create') }}">
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
                                <th>Câu hỏi</th>
                                <th>Người trả lời</th>
                                <th>Thời gian trả lời</th>
                                <th>Lượt xem</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($answers as $index => $answer)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $answer->question->title }}</td>
                                    <td>{{ $answer->responder }}</td>
                                    <td class="text-center">{{ $answer->answerDateAtVi }}</td>
                                    <td class="text-center">{{ $answer->view }}</td>
                                    <td class="text-center">
                                        <span class="{{ $answer->status == 1 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $answer->status == 1 ? 'Phê duyệt' : 'Chưa phê duyệt' }}
                                        </span>
                                    </td>
                                    <td class="flex justify-around">
                                        <a href="#" class="cursor-pointer view-answer"
                                            data-id="{{ $answer->id }}" data-title="{{ $answer->question->title }}"
                                            data-responder="{{ $answer->responder }}"
                                            data-answer="{!! $answer->answer !!}"
                                            data-answer_date="{{ $answer->answerDateAtVi }}"
                                            data-status="{{ $answer->status == 1 ? 'Phê duyệt' : 'Chưa phê duyệt' }}"
                                            onclick="showModal(this)">
                                            <i class="fad fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.answers.edit', $answer) }}" type="button"><i
                                                class="text-yellow-600 fa fa-edit"></i></a>
                                        <form id="delete-form-{{ $answer->id }}"
                                            action="{{ route('admin.answers.destroy', $answer) }}" method="POST">
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
                    <div class="flex items-center"><strong>Câu trả lời:</strong> <span id="modal-answer"></span></div>
                    <div><strong>Tên người trả lời:</strong> <span id="modal-responder"></span></div>
                    <div><strong>Thời gian trả lời:</strong> <span id="modal-answer_date"></span></div>
                    <div><strong>Trạng thái:</strong> <span id="modal-status"></span></div>
                    <button class="btn float-end">Close</button>
                </form>
            </div>
        </div>
    </dialog>
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
                document.getElementById('modal-answer').innerHTML = element.getAttribute('data-answer');
                document.getElementById('modal-responder').innerText = element.getAttribute('data-responder');
                document.getElementById('modal-answer_date').innerText = element.getAttribute('data-answer_date');
                document.getElementById('modal-status').innerText = element.getAttribute('data-status');
                document.getElementById('my_modal_5').showModal();
            }
        </script>
    @endPushOnce

</x-admin-layout>
