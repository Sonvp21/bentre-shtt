<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.industrial_designs.index') }}">Danh sách kiểu dáng</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.industrial_designs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Nhóm ngành</span>
                                </div>
                                <select name="type_id" id="type_id"
                                    class="input input-bordered w-full @error('type_id') border-red-500 @enderror">
                                    <option value="">Chọn nhóm ngành</option>
                                    @foreach ($industrialDesignType as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên kiểu dáng</span>
                                </div>
                                <input type="text" name="name" placeholder="..." value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ kiểu dáng</span>
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
                                    <span class="text-sm font-medium text-gray-700">Mô tả</span>
                                </div>
                                <textarea name="description" id="description"
                                    class="form-textarea input input-bordered w-full @error('description') border-red-500 @enderror" rows="4">{{ old('description') }}</textarea>
                                @error('description')
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
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tài liệu đính kèm</span>
                                </div>
                                <input type="file" name="document" id="document"
                                    class="file-input file-input-bordered file-input-accent w-full" />
                                @error('document')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <div class="form-group items-center space-x-6">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hình ảnh</span>
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose photo</span>
                                    <input type="file" name="image" onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                                <div class="shrink-0 ">
                                    <img id="preview_img" class="h-24 w-28 rounded-md object-cover"
                                        src="{{ asset('adminpage/image/image_default.png') }}" alt="Current photo" />
                                </div>
                            </div>
                        </div>
                        {{-- Cột 2 --}}
                        <div>
                            {{-- huyện --}}
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Huyện</span>
                                </div>
                                <select name="district_id" id="district_id"
                                    class="input input-bordered w-full @error('district_id') border-red-500 @enderror">
                                    <option value="">Chọn huyện</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', request('district_id')) == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            {{-- xã  --}}
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Xã</span>
                                </div>
                                <select name="commune_id" id="commune_id"
                                    class="input input-bordered w-full @error('commune_id') border-red-500 @enderror">
                                    <option value="">Chọn xã</option>
                                    @foreach ($communes as $commune)
                                        <option value="{{ $commune->id }}"
                                            {{ old('commune_id') == $commune->id ? 'selected' : '' }}>
                                            {{ $commune->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('commune_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>


                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn gốc</span>
                                </div>
                                <input type="text" name="application_number" placeholder="Nhập vào"
                                    value="{{ old('application_number') }}"
                                    class="input input-bordered w-full {{ $errors->has('application_number') ? 'input-error' : '' }}" />
                                @error('application_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày nộp đơn</span>
                                </div>
                                <input type="date" name="submission_date" placeholder="Select Submission Date"
                                    value="{{ old('submission_date') }}"
                                    class="input input-bordered w-full @error('submission_date') border-red-500 @enderror" />
                                @error('submission_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái đơn</span>
                                </div>
                                <select name="submission_status"
                                    class="input input-bordered w-full @error('submission_status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="1" {{ old('submission_status') == '1' ? 'selected' : '' }}>
                                        Đang xử lý</option>
                                    <option value="2" {{ old('submission_status') == '2' ? 'selected' : '' }}>Đã
                                        cấp</option>
                                    <option value="3" {{ old('submission_status') == '3' ? 'selected' : '' }}>Bị
                                        từ chối</option>
                                </select>
                                @error('submission_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày công bố</span>
                                </div>
                                <input type="date" name="publication_date" placeholder="Select Publication Date"
                                    value="{{ old('publication_date') }}"
                                    class="input input-bordered w-full @error('publication_date') border-red-500 @enderror" />
                                @error('publication_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn công bố</span>
                                </div>
                                <input type="text" name="publication_number" placeholder="Nhập vào"
                                    value="{{ old('publication_number') }}"
                                    class="input input-bordered w-full {{ $errors->has('publication_number') ? 'input-error' : '' }}" />
                                @error('publication_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp</span>
                                </div>
                                <input type="date" name="design_date" placeholder="Select Publication Date"
                                    value="{{ old('design_date') }}"
                                    class="input input-bordered w-full @error('design_date') border-red-500 @enderror" />
                                @error('design_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!--  Out of Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn</span>
                                </div>
                                <input type="date" name="design_out_of_date"
                                    placeholder="Select Patent Out of Date" value="{{ old('design_out_of_date') }}"
                                    class="input input-bordered w-full @error('design_out_of_date') border-red-500 @enderror" />
                                @error('design_out_of_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái hiệu lực</span>
                                </div>
                                <select name="design_status"
                                    class="input input-bordered w-full @error('design_status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="1" {{ old('design_status') == '1' ? 'selected' : '' }}>
                                        Hiệu lực</option>
                                    <option value="2" {{ old('design_status') == '2' ? 'selected' : '' }}>Hết hạn</option>
                                    <option value="3" {{ old('design_status') == '3' ? 'selected' : '' }}>Bị huỷ</option>
                                </select>
                                @error('design_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                        </div>
                    </div>
                </div>
                <div class="flex gap-4 justify-center m-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.industrial_designs.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>

        </div>
    </div>


    @pushonce('bottom_scripts')
        {{-- lấy xã theo huyện  --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>

        <script>
            var loadFile = function(event) {
                var input = event.target;
                var file = input.files[0];
                var type = file.type;

                var output = document.getElementById('preview_img');

                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // free memory
                }
            };
        </script>
    @endpushonce

</x-admin-layout>
