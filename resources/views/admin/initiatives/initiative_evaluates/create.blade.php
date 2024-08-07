<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                    <li><a href="{{ route('admin.initiative_evaluates.index') }}">Danh sách hội đồng thông qua</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.initiative_evaluates.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">

                        {{-- Cột 2 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hồ sơ sáng kiến</span>
                                </div>
                                <select name="initiative_dossier_id" id="initiative_dossier_id"
                                    class="input input-bordered w-full @error('initiative_dossier_id') border-red-500 @enderror">
                                    <option value="">Chọn hồ sơ</option>
                                    @foreach ($initiativeDossier as $dossier)
                                        <option value="{{ $dossier->id }}"
                                            {{ old('initiative_dossier_id') == $dossier->id ? 'selected' : '' }}>
                                            {{ $dossier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('initiative_dossier_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên Hội đồng</span>
                                </div>
                                <input type="text" name="name_evaluation" placeholder="..." value="{{ old('name_evaluation') }}"
                                    class="input input-bordered w-full {{ $errors->has('name_evaluation') ? 'input-error' : '' }}" />
                                @error('name_evaluation')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Thành viên hội đồng</span>
                                </div>
                                <input type="text" name="name_member" placeholder="Nguyễn Văn A"
                                    value="{{ old('name_member') }}"
                                    class="input input-bordered w-full {{ $errors->has('name_member') ? 'input-error' : '' }}" />
                                @error('name_member')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        {{-- Cột 3 --}}
                        <div>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Điểm số</span>
                                </div>
                                <input type="text" name="score" placeholder="..."
                                    value="{{ old('score') }}"
                                    class="input input-bordered w-full {{ $errors->has('score') ? 'input-error' : '' }}" />
                                @error('score')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày chấm</span>
                                </div>
                                <input type="date" name="submission_date" placeholder="Select Submission Date"
                                    value="{{ old('submission_date') }}"
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
                                    <option value="1" {{ old('submission_status') == '1' ? 'selected' : '' }}>Đang
                                        chờ xử lý</option>
                                    <option value="2" {{ old('submission_status') == '2' ? 'selected' : '' }}>Đang
                                        được xem xét</option>
                                    <option value="3" {{ old('submission_status') == '3' ? 'selected' : '' }}>Đã
                                        chấm</option>
                                    <option value="4" {{ old('submission_status') == '4' ? 'selected' : '' }}>Bị
                                        từ chối</option>
                                </select>
                                @error('submission_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-center pb-3">
                        <a href="{{ route('admin.initiative_evaluates.index') }}"
                            class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
