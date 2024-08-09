<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">

            <ul>
                <li><a href="{{ route('admin.advisory_supports.categories.index') }}">Danh sách danh mục thông tin hỗ trợ, tư vấn</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.advisory_supports.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-1 p-4">
                    <div class="col-span-2">
                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Tên danh mục</span>
                            </div>
                                <input type="text" id="name" name="name" value="{{ old('name', $category->title) }}"
                                 class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}"
                                required>
                            @error('name')
                                <small class="text-red-500 text-left">{{ $message }}</small>
                            @enderror
                        </label>
                    </div>
                </div>

                <div class="flex gap-4 justify-center p-3">
                    <a href="{{ route('admin.advisory_supports.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                </div>
            </form>

        </div>
    </div>

</x-admin-layout>
