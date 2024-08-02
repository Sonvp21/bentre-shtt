<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.districts.index') }}" class="font-semibold">Danh sách Huyện</a></li>
                <li><a class="text-teal-600 font-semibold">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <form action="{{ route('admin.districts.update', $district) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 p-3">
                    <div class="grid grid-cols-2 gap-1">

                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Tên huyện</span>
                                </div>
                                <input type="text" name="name" placeholder="Type here"
                                    value="{{ old('name', $district->name) }}" @class([
                                        'input',
                                        'text-sm',
                                        'input-bordered',
                                        'w-full',
                                        'input-error' => $errors->has('name'),
                                    ]) />
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Diện tích (km²)</span>
                                </div>
                                <input type="text" name="area" placeholder="Type here"
                                    value="{{ old('area', $district->area) }}" @class([
                                        'input',
                                        'text-sm',
                                        'input-bordered',
                                        'w-full',
                                        'input-error' => $errors->has('area'),
                                    ]) />
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Dân số</span>
                                </div>
                                <input type="text" name="population" placeholder="Type here"
                                    value="{{ old('population', $district->population) }}"
                                    @class([
                                        'input',
                                        'text-sm',
                                        'input-bordered',
                                        'w-full',
                                        'input-error' => $errors->has('population'),
                                    ]) />
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Cập nhật năm</span>
                                </div>
                                <input type="text" name="updated_year" placeholder="Type here"
                                    value="{{ old('updated_year', $district->updated_year) }}"
                                    @class([
                                        'input',
                                        'text-sm',
                                        'input-bordered',
                                        'w-full',
                                        'input-error' => $errors->has('updated_year'),
                                    ]) />
                            </label>
                        </div>
                    </div>

                    <div class="flex  gap-4">
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9">
                            @lang('admin.btn.submit')
                        </button>
                        <a href="{{ route('admin.districts.index') }}" class="btn btn-outline btn-error !min-h-9 h-9">
                            @lang('admin.btn.cancel')
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-admin-layout>
