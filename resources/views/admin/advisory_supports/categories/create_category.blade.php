<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                    <li><a href="{{ route('admin.advisory_supports.categories.index') }}">Danh sách danh mục thông tin hỗ trợ, tư vấn</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.advisory_supports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-1 ...">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên danh mục</span>
                                </div>
                                <input type="text" name="name" placeholder="..." value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-center pb-3 mt-5">
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                        <a href="{{ route('admin.advisory_supports.categories.index') }}"
                            class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>

