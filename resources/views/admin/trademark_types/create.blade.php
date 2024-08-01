<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            <ul>
                    <li><a href="{{ route('admin.trademark_types.index') }}">Danh sách nhóm ngành</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.trademark_types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên nhóm ngành</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào" value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4 mt-5">
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                        <a href="{{ route('admin.trademark_types.index') }}" class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
