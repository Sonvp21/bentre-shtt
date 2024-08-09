<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.communes.index') }}" class="font-semibold">Danh sách Xã</a></li>
                <li><a class="text-teal-600 font-semibold">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <form action="{{ route('admin.communes.update', $commune) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 p-3">
                    <div class="grid grid-cols-2 gap-1">

                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Huyện</span>
                                </div>
                                <select name="district_id" class="input input-bordered w-full text-sm">
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ $commune->district_id == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Tên xã</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $commune->name) }}"
                                    class="input text-sm input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Diện tích (km²)</span>
                                </div>
                                <input type="text" name="area" placeholder="Nhập vào"
                                    value="{{ old('area', $commune->area) }}"
                                    class="input text-sm input-bordered w-full {{ $errors->has('area') ? 'input-error' : '' }}" />
                                @error('area')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Dân số</span>
                                </div>
                                <input type="text" name="population" placeholder="Nhập vào"
                                    value="{{ old('population', $commune->population) }}"
                                    class="input text-sm input-bordered w-full {{ $errors->has('population') ? 'input-error' : '' }}" />
                                @error('population')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                        <div class="...">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Cập nhật năm</span>
                                </div>
                                <input type="text" name="updated_year" placeholder="Nhập vào"
                                    value="{{ old('updated_year', $commune->updated_year) }}"
                                    class="input text-sm input-bordered w-full {{ $errors->has('updated_year') ? 'input-error' : '' }}" />
                                @error('updated_year')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
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
