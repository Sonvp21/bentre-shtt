<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.technical_innovation_results.index') }}">Danh sách vi phạm</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.technical_innovation_results.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 px-3">
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="grid grid-cols-3 gap-4 !m-0">
                    <div class="col-span-2">
                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Hồ sơ</span>
                            </div>
                            <select name="technical_id" id="technical_id"
                                class="input input-bordered w-full @error('technical_id') border-red-500 @enderror">
                                <option value="">Chọn hồ sơ</option>
                                @foreach ($dossiers as $dossier)
                                    <option value="{{ $dossier->id }}"
                                        {{ old('technical_id') == $dossier->id ? 'selected' : '' }}>
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
                                <span class="text-sm font-medium text-gray-700">Năm thi</span>
                            </div>
                            <select id="year" name="year"
                                class="input input-bordered w-full @error('year') border-red-500 @enderror">
                                <option value="">Lựa chọn</option>
                                @for ($year = now()->year; 2015 <= $year; $year--)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('year')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </label>
                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Xếp hạng</span>
                            </div>
                            <input type="text" name="rank" placeholder="Nhập vào" value="{{ old('rank') }}"
                                class="input input-bordered w-full {{ $errors->has('rank') ? 'input-error' : '' }}" />
                            @error('rank')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">trạng thái</span>
                            </div>
                            <textarea name="status" id="status" placeholder="..."
                                class="h-auto form-textarea input input-bordered w-full @error('status') border-red-500 @enderror">{{ old('status') }}</textarea>
                            @error('status')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.technical_innovation_results.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    
                </div>
            </form>

        </div>
    </div>

</x-admin-layout>
