<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.technical_innovation_results.index') }}">Danh sách vi phạm</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.technical_innovation_results.update', $technicalInnovationResult->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div>
                            <label class="form-control">
                                <span class="text-sm font-medium text-gray-700">Hồ sơ</span>
                                <select name="technical_id" id="technical_id"
                                    class="input input-bordered w-full @error('technical_id') border-red-500 @enderror">
                                    <option value="">Chọn hồ sơ</option>
                                    @foreach ($dossiers as $dossier)
                                        <option value="{{ $dossier->id }}"
                                            {{ $technicalInnovationResult->technical_id == $dossier->id ? 'selected' : '' }}>
                                            {{ $dossier->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('technical_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div>
                            <label class="form-control">
                                <span class="text-sm font-medium text-gray-700">Năm thi</span>
                                <select id="year" name="year"
                                    class="input input-bordered w-full @error('year') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    @for ($year = now()->year; 2015 <= $year; $year--)
                                        <option value="{{ $year }}"
                                            {{ $technicalInnovationResult->year == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('year')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div>
                            <label class="form-control">
                                <span class="text-sm font-medium text-gray-700">Xếp hạng</span>
                                <input type="text" name="rank" placeholder="Nhập vào"
                                    value="{{ $technicalInnovationResult->rank }}"
                                    class="input input-bordered w-full @error('rank') border-red-500 @enderror" />
                                @error('rank')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div>
                            <label class="form-control">
                                <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                <textarea name="status" id="status" placeholder="..."
                                    class="h-auto form-textarea input input-bordered w-full @error('status') border-red-500 @enderror">{{ $technicalInnovationResult->status }}</textarea>
                                @error('status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.technical_innovation_results.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    
                </div>
            </form>

        </div>
    </div>
</x-admin-layout>
