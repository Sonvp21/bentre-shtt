<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.technical_innovation_dossiers.index') }}">Danh sách hồ sơ sáng tạo kỹ thuật
                        <menu type="context"></menu></a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.technical_innovation_dossiers.update', $technicalInnovationDossier->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên hồ sơ</span>
                                </div>
                                <input type="text" name="unit_name" placeholder="Nhập vào"
                                    value="{{ old('unit_name', $technicalInnovationDossier->unit_name) }}"
                                    class="input input-bordered w-full {{ $errors->has('unit_name') ? 'input-error' : '' }}" />
                                @error('unit_name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên đơn vị</span>
                                </div>
                                <input type="text" name="field" placeholder="Nhập vào"
                                    value="{{ old('field', $technicalInnovationDossier->field) }}"
                                    class="input input-bordered w-full {{ $errors->has('field') ? 'input-error' : '' }}" />
                                @error('field')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Lĩnh vực</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $technicalInnovationDossier->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày nộp</span>
                                </div>
                                <input type="date" name="submission_date" placeholder="Select Submission Date"
                                    value="{{ old('submission_date', $technicalInnovationDossier->submission_date ? \Carbon\Carbon::parse($technicalInnovationDossier->submission_date)->format('Y-m-d') : '') }}"
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
                                        {{ old('submission_status', $technicalInnovationDossier->submission_status) == '1' ? 'selected' : '' }}>
                                        Đang xử lý</option>
                                    <option value="2"
                                        {{ old('submission_status', $technicalInnovationDossier->submission_status) == '2' ? 'selected' : '' }}>
                                        Đã
                                        cấp</option>
                                    <option value="3"
                                        {{ old('submission_status', $technicalInnovationDossier->submission_status) == '3' ? 'selected' : '' }}>
                                        Bị
                                        từ chối</option>
                                </select>
                                @error('submission_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Document</span>
                                </div>
                                @if ($technicalInnovationDossier->hasMedia('document_technical'))
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tệp hiện tại:</span>
                                        <a id="currentDocumentLink"
                                            href="{{ $technicalInnovationDossier->getFirstMedia('document_technical')->getUrl() }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $technicalInnovationDossier->getFirstMedia('document_technical')->file_name }}
                                        </a>
                                        <label for="document"
                                            class="text-sm text-red-600 cursor-pointer hover:underline">
                                            Đổi tệp
                                        </label>
                                        <input id="document" type="file" name="document" style="display: none;"
                                            onchange="updateDocumentName(event)" />
                                    </div>
                                @else
                                    <input id="document" type="file" name="document"
                                        class="w-full max-w-xs file-input file-input-bordered file-input-accent" />
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
                    </div>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.technical_innovation_dossiers.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>

        </div>
    </div>
</x-admin-layout>
