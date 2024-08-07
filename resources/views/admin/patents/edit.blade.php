<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.patents.index') }}" class="font-semibold">Danh sách sáng chế</a></li>
                <li><a class="text-teal-600 font-semibold">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.patents.update', $patent) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-2 ...">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Mã
                                        <span class="text-red-500">*</span>
                                    </span>
                                </div>
                                <input type="text" name="code" placeholder="Nhập vào"
                                    value="{{ old('code', $patent->code) }}"
                                    class="input input-bordered w-full {{ $errors->has('code') ? 'input-error' : '' }}" />
                                @error('code')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên Sáng chế
                                        <span class="text-red-500">*</span>
                                    </span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $patent->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Mô tả</span>
                                </div>
                                <textarea name="description" id="description"
                                    class="form-textarea input input-bordered w-full @error('description') border-red-500 @enderror" rows="4">{{ old('description', $patent->description) }}</textarea>
                                @error('description')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đại diện pháp luật
                                        <span class="text-red-500">*</span>
                                    </span>
                                </div>
                                <input type="text" name="legal_representative"
                                    placeholder="Enter Legal Representative"
                                    value="{{ old('legal_representative', $patent->legal_representative) }}"
                                    class="input input-bordered w-full {{ $errors->has('legal_representative') ? 'input-error' : '' }}" />
                                @error('legal_representative')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Document</span>
                                </div>
                                @if ($patent->hasMedia('documents'))
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tệp hiện tại:</span>
                                        <a id="currentDocumentLink"
                                            href="{{ $patent->getFirstMedia('documents')->getUrl() }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $patent->getFirstMedia('documents')->file_name }}
                                        </a>
                                        <label for="document"
                                            class="text-sm text-red-600 hover:underline cursor-pointer">
                                            Đổi tệp
                                        </label>
                                        <input id="document" type="file" name="document" style="display: none;"
                                            onchange="updateDocumentName(event)" />
                                    </div>
                                @else
                                    <input id="document" type="file" name="document"
                                        class="file-input file-input-bordered file-input-accent w-full" />
                                    @error('document')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                @endif
                            </label>

                            <script>
                                function updateDocumentName(event) {
                                    const input = event.target;
                                    const fileName = input.files[0].name;
                                    const linkElement = document.getElementById('currentDocumentLink');
                                    linkElement.textContent = fileName;
                                }
                            </script>


                            <div class="form-group items-center space-x-6 pt-4">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hình ảnh</span>
                                </div>
                                <label class="block">
                                    <span class="sr-only">Chọn ảnh</span>
                                    <input type="file" name="image" onchange="loadFile(event)"
                                        class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                                <div class="shrink-0" style="text-align: -webkit-center;">
                                    @php
                                        $imageUrl = $patent->getFirstMediaUrl('patent_image');
                                        $defaultImageUrl = asset('adminpage/image/image_default.png');
                                    @endphp
                                    <img id="preview_img" class="h-56 w-auto rounded-md object-cover"
                                        src="{{ $imageUrl ? $imageUrl : $defaultImageUrl }}" alt="Current photo" />
                                </div>
                            </div>
                        </div>
                        {{-- Column 2 --}}
                        <div>
                            {{-- District --}}
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Huyện</span>
                                </div>
                                <select name="district_id" id="district_id"
                                    class="input input-bordered w-full @error('district_id') border-red-500 @enderror">
                                    <option value="">Chọn huyện</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', $patent->district_id) == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            {{-- Commune --}}
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Xã</span>
                                </div>
                                <select name="commune_id" id="commune_id"
                                    class="input input-bordered w-full @error('commune_id') border-red-500 @enderror">
                                    <option value="">Chọn xã</option>
                                    @foreach ($communes as $commune)
                                        <option value="{{ $commune->id }}"
                                            {{ old('commune_id', $patent->commune_id) == $commune->id ? 'selected' : '' }}>
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
                                    <span class="text-sm font-medium text-gray-700">Số đơn
                                        <span class="text-red-500">*</span>
                                    </span>
                                </div>
                                <input type="text" name="application_number" placeholder="Nhập vào"
                                    value="{{ old('application_number', $patent->application_number) }}"
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
                                    value="{{ old('submission_date', $patent->submission_date ? \Carbon\Carbon::parse($patent->submission_date)->format('Y-m-d') : '') }}"
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
                                    <option value="1"
                                        {{ old('submission_status', $patent->submission_status) == '1' ? 'selected' : '' }}>
                                        Đang xử lý</option>
                                    <option value="2"
                                        {{ old('submission_status', $patent->submission_status) == '2' ? 'selected' : '' }}>
                                        Đã
                                        cấp</option>
                                    <option value="3"
                                        {{ old('submission_status', $patent->submission_status) == '3' ? 'selected' : '' }}>
                                        Bị
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
                                    value="{{ old('publication_date', $patent->publication_date ? \Carbon\Carbon::parse($patent->publication_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('publication_date') border-red-500 @enderror" />
                                @error('publication_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Number Patent -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số bằng</span>
                                </div>
                                <input type="text" name="number_patent" placeholder="Enter Number Patent"
                                    value="{{ old('number_patent', $patent->number_patent) }}"
                                    class="input input-bordered w-full @error('number_patent') border-red-500 @enderror" />
                                @error('number_patent')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp</span>
                                </div>
                                <input type="date" name="patent_date" placeholder="Select Patent Date"
                                    value="{{ old('patent_date', $patent->patent_date ? \Carbon\Carbon::parse($patent->patent_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('patent_date') border-red-500 @enderror" />
                                @error('patent_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Out of Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn bằng</span>
                                </div>
                                <input type="date" name="patent_out_of_date"
                                    placeholder="Select Patent Out of Date"
                                    value="{{ old('patent_out_of_date', $patent->patent_out_of_date ? \Carbon\Carbon::parse($patent->patent_out_of_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('patent_out_of_date') border-red-500 @enderror" />
                                @error('patent_out_of_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Status -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái bằng</span>
                                </div>
                                <select name="patent_status"
                                    class="input input-bordered w-full @error('patent_status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="1"
                                        {{ old('patent_status', $patent->patent_status) == '1' ? 'selected' : '' }}>
                                        Hiệu lực</option>
                                    <option value="2"
                                        {{ old('patent_status', $patent->patent_status) == '2' ? 'selected' : '' }}>Hết
                                        hạn</option>
                                    <option value="3"
                                        {{ old('patent_status', $patent->patent_status) == '3' ? 'selected' : '' }}>Bị
                                        huỷ</option>
                                </select>
                                </select>
                                @error('patent_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                        </div>
                        <!-- Tọa độ -->
                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Kinh độ</span>
                            </div>
                            <input type="text" id="longitude" name="longitude" placeholder="Nhập kinh độ"
                                value="{{ old('longitude', $patent->getLongitude($patent->id)) }}"
                                class="input input-bordered w-full {{ $errors->has('longitude') ? 'input-error' : '' }}" />
                            @error('longitude')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Vĩ độ</span>
                            </div>
                            <input type="text" id="latitude" name="latitude" placeholder="Nhập vĩ độ"
                                value="{{ old('latitude', $patent->getLatitude($patent->id)) }}"
                                class="input input-bordered w-full {{ $errors->has('latitude') ? 'input-error' : '' }}" />
                            @error('latitude')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </label>

                    </div>
                    <div id="map" style="height: 500px; width: 100%;"></div>

                    <!-- Nút để lấy tọa độ hiện tại của người dùng -->
                    <button id="getCurrentLocation" class="btn btn-link float-left !m-0" type="button">Lấy vị trí
                        hiện tại</button>

                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 px-4">Lưu</button><a
                        href="{{ route('admin.patents.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>
        </div>

    </div>

    @pushonce('bottom_scripts')
        {{-- Get communes based on district --}}
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

        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbbI-IH80_-AgZbiq1lKAkcOoavIWTEc&callback=initMap"></script>
        <script src='{{ asset('adminpage/map/getlocation_edit.js') }}'></script>
        
    @endpushonce

</x-admin-layout>
