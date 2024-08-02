<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <span class="text-3xl uppercase font-semibold">
            Thống kê kết quả sáng tạo kỹ thuật
        </span>
        <x-admin.alerts.success />
        <div class="justify-between w-max ml-auto self-center mt-10 ">
            <a class="btn btn-outline btn-accent !min-h-9 h-9"
                href="{{ route('admin.technical_innovation_results.index') }}">
                Danh sách
            </a>
        </div>
        <div class="flex p-3">
            <!-- Form lọc -->
            <form id="filterForm">
                <div class="grid grid-cols-5 gap-4 items-center">
                    <div class="form-control mx-1 w-full">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Tìm kiếm" class="input input-sm input-bordered w-32">
                    </div>

                    <!-- Trường chọn Name -->
                    <select name="name" class="select select-bordered select-sm w-full max-w-sm text-sm input-bordered">
                        <option value="">Tên hồ sơ</option>
                        @foreach ($names as $name)
                            <option value="{{ $name }}" {{ request('name') == $name ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Trường chọn Unit Name -->
                    <select name="unit_name" class="select select-bordered select-sm w-full max-w-sm text-sm input-bordered">
                        <option value="">Đơn vị</option>
                        @foreach ($unitNames as $unitName)
                            <option value="{{ $unitName }}"
                                {{ request('unit_name') == $unitName ? 'selected' : '' }}>
                                {{ $unitName }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Trường chọn Field -->
                    <select name="field" class="select select-bordered select-sm w-full max-w-sm text-sm input-bordered">
                        <option value="">Lĩnh vực</option>
                        @foreach ($fields as $field)
                            <option value="{{ $field }}" {{ request('field') == $field ? 'selected' : '' }}>
                                {{ $field }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Trường chọn Year -->
                    <select name="year" class="select select-bordered select-sm w-full max-w-sm text-sm input-bordered">
                        <option value="">Năm</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </form>
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
