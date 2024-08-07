<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
            Danh sách kết quả sáng tạo kỹ thuật
        </span>
        <x-admin.alerts.success />

        <div class="flex mt-10">
            <!-- Form lọc -->
            <form id="filterForm" class="mb-4">
                <div class="grid grid-cols-5 gap-4">
                    <div class="form-control mx-1 w-full">
                        <label class="label">
                            <span class="label-text">Tìm kiếm</span>
                        </label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Tìm kiếm" class="input input-sm input-bordered w-32">
                    </div>
                </div>
            </form>

            <div class="justify-between w-max ml-auto self-center">
                <a class="btn btn-outline btn-accent !min-h-9 h-9"
                    href="{{ route('admin.technical_innovation_results.statistical') }}">
                    <i class="fad fa-chart-line"></i> Thống kê
                </a>
                <a class="btn btn-outline btn-accent !min-h-9 h-9"
                    href="{{ route('admin.technical_innovation_results.create') }}">
                    <i class="fad fa-plus-circle"></i>
                </a>
            </div>
            <!-- xuất excel, pdf -->
        </div>

        <!-- Hiển thị danh sách kết quả -->
        <div id="technical_innovation_resultsList" class="overflow-x-auto bg-white rounded-lg">
            @include('admin.technical_innovations.technical_innovation_results.ajax_list', [
                'results' => $results,
            ])
        </div>
    </div>

    @pushOnce('bottom_scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function sendAjaxRequests() {
                    const formData = new FormData(document.getElementById('filterForm'));

                    fetch("{{ route('admin.technical_innovation_results.ajax_list') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById('technical_innovation_resultsList').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                }

                document.querySelectorAll('.input-bordered, #search').forEach(element => {
                    element.addEventListener('input', function() {
                        sendAjaxRequests();
                    });
                });

                sendAjaxRequests();
            });
        </script>
    @endPushOnce
</x-admin-layout>
