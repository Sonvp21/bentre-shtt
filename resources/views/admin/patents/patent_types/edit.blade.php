<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.patent_types.index') }}">Danh sách lĩnh vực</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.patent_types.update', $patentType) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- Column 1 --}}
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên lĩnh vực</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $patentType->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center">
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                        <a href="{{ route('admin.patent_types.index') }}"
                            class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
