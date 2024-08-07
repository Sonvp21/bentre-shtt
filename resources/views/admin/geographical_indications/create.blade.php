<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.geographical_indications.index') }}">Danh sách sáng chế</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.geographical_indications.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- Cột 2 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên sản phẩm  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào" value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đơn vị quản lý  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="management_unit" placeholder="Nhập vào"
                                    value="{{ old('management_unit') }}"
                                    class="input input-bordered w-full {{ $errors->has('management_unit') ? 'input-error' : '' }}" />
                                @error('management_unit')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đơn vị uỷ quyền  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="authorized_unit" placeholder="Nhập vào"
                                    value="{{ old('authorized_unit') }}"
                                    class="input input-bordered w-full {{ $errors->has('authorized_unit') ? 'input-error' : '' }}" />
                                @error('authorized_unit')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">@lang('admin.content')</span>
                                </div>
                                <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content ?? '') }}</textarea>

                            </label>

                        </div>
                        {{-- Cột 3 --}}
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
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="application_number" placeholder="Nhập vào"
                                    value="{{ old('application_number') }}"
                                    class="input input-bordered w-full {{ $errors->has('application_number') ? 'input-error' : '' }}" />
                                @error('application_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số văn bằng  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="certificate_number" placeholder="Enter Number Patent"
                                    value="{{ old('certificate_number') }}"
                                    class="input input-bordered w-full @error('certificate_number') border-red-500 @enderror" />
                                @error('certificate_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="date" name="issue_date" placeholder="Select Submission Date"
                                    value="{{ old('issue_date') }}"
                                    class="input input-bordered w-full @error('issue_date') border-red-500 @enderror" />
                                @error('issue_date')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tài liệu đính kèm</span>
                                </div>
                                <input type="file" name="document" id="document"
                                    class="file-input file-input-bordered file-input-accent w-full" />
                                @error('document')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                    </div>
                    <label class="form-control w-[95%] pb-3">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Ghi chú</span>
                        </div>
                        <textarea name="status" id="status"
                            class="textarea textarea-bordered @error('status') border-red-500 @enderror" rows="2">{{ old('status') }}</textarea>
                        @error('status')
                            <small class="text-red-500 text-left">{{ $message }}</small>
                        @enderror
                    </label>
                </div>
                <div class="flex justify-center pb-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.geographical_indications.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>
        </div>
    </div>


    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="content" model="Post" />
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
        {{-- lấy xã theo huyện  --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>
    @endpushonce

</x-admin-layout>
