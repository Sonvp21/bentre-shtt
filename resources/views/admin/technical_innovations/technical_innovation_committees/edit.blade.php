<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.technical_innovation_committees.index') }}">Danh sách vi phạm<menu
                            type="context"></menu></a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.technical_innovation_committees.update', $technicalInnovationCommittee->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên vi phạm</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $technicalInnovationCommittee->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hồ sơ</span>
                                </div>
                                <select name="technical_id" id="technical_id"
                                    class="input input-bordered w-full @error('technical_id') border-red-500 @enderror">
                                    <option value="">Chọn hồ sơ</option>
                                    @foreach ($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}"
                                            {{ old('technical_id', $dossier->id) == $dossier->id ? 'selected' : '' }}>
                                            {{ $dossier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('technical_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Điểm số</span>
                                </div>
                                <input type="text" name="score" placeholder="Nhập vào"
                                    value="{{ old('score', $technicalInnovationCommittee->score) }}"
                                    class="input input-bordered w-full {{ $errors->has('score') ? 'input-error' : '' }}" />
                                @error('score')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>


                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày đăng</span>
                                </div>
                                <input type="date" name="date" placeholder="Select Submission Date"
                                    value="{{ old('date', $technicalInnovationCommittee->date ? \Carbon\Carbon::parse($technicalInnovationCommittee->date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('date') border-red-500 @enderror" />
                                @error('date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">trạng thái</span>
                                </div>
                                <textarea name="status" id="status" placeholder="Phát hiện ban đầu, Đang điều tra, Xác nhận vi phạm..."
                                    class="h-auto form-textarea input input-bordered w-full @error('status') border-red-500 @enderror">
                                    {{ old('status', $technicalInnovationCommittee->status) }}
                                </textarea>
                                @error('status')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.technical_innovation_committees.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>

                </div>
            </form>

        </div>
    </div>

</x-admin-layout>
