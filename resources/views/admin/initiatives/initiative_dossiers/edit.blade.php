<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            <ul>
                    <li><a href="{{ route('admin.initiative_dossiers.index') }}">Danh sách Hồ sơ sáng kiến</a></li>
                    <li><a class="text-teal-600">Chỉnh sửa</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.initiative_dossiers.update', $initiativeDossier->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-flow-row-dense grid-cols-4 grid-rows-1 ...">

                        {{-- Cột 2 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Sáng kiến</span>
                                </div>
                                <select name="initiative_id" id="initiative_id"
                                    class="input input-bordered w-full @error('initiative_id') border-red-500 @enderror">
                                    <option value="">Chọn sáng kiến</option>
                                    @foreach ($initiatives as $initiative)
                                        <option value="{{ $initiative->id }}"
                                            {{ old('initiative_id', $initiativeDossier->initiative_id) == $initiative->id ? 'selected' : '' }}>
                                            {{ $initiative->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('initiative_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên Hồ sơ sáng kiến</span>
                                </div>
                                <input type="text" name="name" placeholder="..."
                                    value="{{ old('name', $initiativeDossier->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Document</span>
                                </div>
                                @if ($initiativeDossier->hasMedia('document_initiatives'))
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tệp hiện tại:</span>
                                        <a id="currentDocumentLink"
                                            href="{{ $initiativeDossier->getFirstMedia('document_initiatives')->getUrl() }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $initiativeDossier->getFirstMedia('document_initiatives')->file_name }}
                                        </a>
                                        <label for="document"
                                            class="text-sm text-red-600 hover:underline cursor-pointer">
                                            Đổi tệp
                                        </label>
                                        <input id="document" type="file" name="document" style="display: none;"
                                            onchange="updateDocumentName(event)" />
                                    </div>
                                @else
                                    <input id="document" type="file" name="document"
                                        class="file-input file-input-bordered file-input-accent w-full" />
                                    @error('document')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                @endif
                            </label>

                            <script>
                                function updateDocumentName(event) {
                                    const input = event.target;
                                    const fileName = input.files[0].name;
                                    const linkElement = document.getElementById('currentDocumentLink');
                                    linkElement.textContent = fileName;
                                }
                            </script>
                        </div>
                        {{-- Cột 3 --}}
                        <div>


                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày nộp</span>
                                </div>
                                <input type="date" name="submission_date" placeholder="Select Submission Date"
                                    value="{{ old('submission_date', $initiativeDossier->submission_date ? \Carbon\Carbon::parse($initiativeDossier->submission_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('submission_date') border-red-500 @enderror" />
                                @error('submission_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="submission_status"
                                    class="input input-bordered w-full @error('submission_status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="1"
                                        {{ old('submission_status', $initiativeDossier->submission_status) == '1' ? 'selected' : '' }}>
                                        Đang
                                        chờ xử lý</option>
                                    <option value="2"
                                        {{ old('submission_status', $initiativeDossier->submission_status) == '2' ? 'selected' : '' }}>
                                        Đang
                                        được xem xét</option>
                                    <option value="3"
                                        {{ old('submission_status', $initiativeDossier->submission_status) == '3' ? 'selected' : '' }}>
                                        Được phê duyệt</option>
                                    <option value="4"
                                        {{ old('submission_status', $initiativeDossier->submission_status) == '4' ? 'selected' : '' }}>
                                        Bị
                                        từ chối</option>
                                </select>
                                @error('submission_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('admin.initiative_dossiers.index') }}"
                            class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
