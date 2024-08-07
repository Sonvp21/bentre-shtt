<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.initiatives.index') }}">Danh sách sáng kiến</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.initiatives.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên sáng kiến</span>
                                </div>
                                <input type="text" name="name" placeholder="..." value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tác giả</span>
                                </div>
                                <input type="text" name="author" placeholder="Nguyễn Văn A"
                                    value="{{ old('author') }}"
                                    class="input input-bordered w-full {{ $errors->has('author') ? 'input-error' : '' }}" />
                                @error('author')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ sáng kiến</span>
                                </div>
                                <input type="text" name="owner" placeholder="Nguyễn Văn A"
                                    value="{{ old('owner') }}"
                                    class="input input-bordered w-full {{ $errors->has('owner') ? 'input-error' : '' }}" />
                                @error('owner')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ</span>
                                </div>
                                <input type="text" name="address" placeholder="Nhập địa chỉ"
                                    value="{{ old('address') }}"
                                    class="input input-bordered w-full {{ $errors->has('address') ? 'input-error' : '' }}" />
                                @error('address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Lĩnh vực</span>
                                </div>
                                <input type="text" name="fields" placeholder="Nông, lâm, nghiệp,...."
                                    value="{{ old('fields') }}"
                                    class="input input-bordered w-full {{ $errors->has('fields') ? 'input-error' : '' }}" />
                                @error('fields')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        {{-- Cột 3 --}}
                        <div>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Năm công nhận</span>
                                </div>
                                <select id="recognition_year" name="recognition_year"
                                    class="input input-bordered w-full @error('recognition_year') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    @for ($year = now()->year; 2015 <= $year; $year--)
                                        <option value="{{ $year }}">
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('submission_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status"
                                    class="input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Đang chờ xử lý
                                    </option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Đang được xem
                                        xét</option>
                                    <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Được phê duyệt
                                    </option>
                                    <option value="4" {{ old('status') == '4' ? 'selected' : '' }}>Bị từ chối
                                    </option>
                                    <option value="5" {{ old('status') == '5' ? 'selected' : '' }}>Đã triển khai
                                    </option>
                                    <option value="6" {{ old('status') == '6' ? 'selected' : '' }}>Hết hạn
                                    </option>
                                    <option value="7" {{ old('status') == '7' ? 'selected' : '' }}>Đã rút</option>
                                </select>
                                @error('status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.initiatives.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>

        </div>
    </div>

</x-admin-layout>
