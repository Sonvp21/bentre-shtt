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
                                    <span class="text-sm font-medium text-gray-700">Lĩnh vực</span>
                                </div>
                                <select name="type_id" id="type_id"
                                    class="input input-bordered w-full @error('type_id') border-red-500 @enderror">
                                    <option value="">Chọn lĩnh vực</option>
                                    @foreach ($patent_types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('type_id', $patent->type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên Sáng chế
                                        <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="title" placeholder="Nhập vào"
                                    value="{{ old('title', $patent->title) }}"
                                    class="input input-bordered w-full {{ $errors->has('title') ? 'input-error' : '' }}" />
                                @error('title')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Phân lại IPC
                                </div>
                                <input type="text" name="ipc_classes" placeholder="Nhập vào"
                                    value="{{ old('ipc_classes', $patent->ipc_classes) }}"
                                    class="input input-bordered w-full {{ $errors->has('ipc_classes') ? 'input-error' : '' }}" />
                                @error('ipc_classes')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ đơn
                                        <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="applicant" placeholder="..."
                                    value="{{ old('applicant', $patent->applicant) }}"
                                    class="input input-bordered w-full {{ $errors->has('applicant') ? 'input-error' : '' }}" />
                                @error('applicant')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ chủ đơn
                                </div>
                                <input type="text" name="applicant_address" placeholder="..."
                                    value="{{ old('applicant_address', $patent->applicant_address) }}"
                                    class="input input-bordered w-full {{ $errors->has('applicant_address') ? 'input-error' : '' }}" />
                                @error('applicant_address')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tác giả
                                </div>
                                <input type="text" name="inventor" placeholder="..."
                                    value="{{ old('inventor', $patent->inventor) }}"
                                    class="input input-bordered w-full {{ $errors->has('inventor') ? 'input-error' : '' }}" />
                                @error('inventor')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ tác giả
                                </div>
                                <input type="text" name="inventor_address" placeholder="..."
                                    value="{{ old('inventor_address', $patent->inventor_address) }}"
                                    class="input input-bordered w-full {{ $errors->has('inventor_address') ? 'input-error' : '' }}" />
                                @error('inventor_address')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tác giả khác
                                </div>
                                <input type="text" name="other_inventor" placeholder="..."
                                    value="{{ old('other_inventor', $patent->other_inventor) }}"
                                    class="input input-bordered w-full {{ $errors->has('other_inventor') ? 'input-error' : '' }}" />
                                @error('other_inventor')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">Tóm tắt</span>
                                </div>
                                <textarea name="abstract" id="abstract"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('abstract') ? 'input-error' : '' }}"
                                    rows="1">{!! old('abstract', $patent->abstract) !!}</textarea>
                                @error('abstract')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đại diện pháp luật
                                </div>
                                <input type="text" name="representative_name"
                                    placeholder="Enter Legal Representative"
                                    value="{{ old('representative_name', $patent->representative_name) }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_name') ? 'input-error' : '' }}" />
                                @error('representative_name')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ đại diện pháp luật
                                </div>
                                <input type="text" name="representative_address"
                                    placeholder="Enter Address Representative"
                                    value="{{ old('representative_address', $patent->representative_address) }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_address') ? 'input-error' : '' }}" />
                                @error('representative_address')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Tệp đính kèm -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tệp đính kèm (tối đa 10MB)</span>
                                </div>
                                <input type="file" id="documents" name="documents[]" multiple
                                    accept=".pdf, .doc, .docx"
                                    class="file-input file-input-bordered file-input-sm w-full max-w-xs {{ $errors->has('documents') ? 'input-error' : '' }}" />
                                @error('documents')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                                <div id="documents-preview">
                                    @foreach ($patent->documents as $document)
                                        <div>{{ $document->file_name }}</div>
                                    @endforeach
                                </div>
                            </label>

                            <!-- Ảnh -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ảnh (tối đa 10MB)</span>
                                </div>
                                <input type="file" id="images" name="images[]" multiple accept="image/(*)"
                                    class="file-input file-input-bordered file-input-sm w-full max-w-xs {{ $errors->has('images') ? 'input-error' : '' }}" />
                                @error('images')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                                <div id="images-preview" class="grid grid-cols-2 gap-4 mt-4">
                                    @foreach ($patent->images as $image)
                                        <div class="flex justify-center items-center">
                                            <img src="{{ asset('storage/' . $image->file_path) }}"
                                                style="max-width: 150px; border-radius: 30px; padding: 10px;"
                                                alt="{{ $image->file_name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </label>
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
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Loại đơn</span>
                                </div>
                                <select name="application_type"
                                    class="input input-bordered w-full @error('application_type') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="non - PCT SC"
                                        {{ old('application_type', $patent->application_type) == 'non - PCT SC' ? 'selected' : '' }}>
                                        non - PCT SC
                                    </option>
                                    <option value="non-PCT Utility"
                                        {{ old('application_type', $patent->application_type) == 'non-PCT Utility' ? 'selected' : '' }}>
                                        non-PCT Utility
                                    </option>
                                </select>
                                @error('application_type')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn
                                        <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="filing_number" placeholder="..."
                                    value="{{ old('filing_number', $patent->filing_number) }}"
                                    class="input input-bordered w-full {{ $errors->has('filing_number') ? 'input-error' : '' }}" />
                                @error('filing_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày nộp đơn</span>
                                </div>
                                <input type="date" name="filing_date" placeholder="Select Submission Date"
                                    value="{{ old('filing_date', $patent->filing_date ? \Carbon\Carbon::parse($patent->filing_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('filing_date') border-red-500 @enderror" />
                                @error('filing_date')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số công bố
                                </div>
                                <input type="text" name="publication_number" placeholder="..."
                                    value="{{ old('publication_number', $patent->publication_number) }}"
                                    class="input input-bordered w-full {{ $errors->has('publication_number') ? 'input-error' : '' }}" />
                                @error('publication_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Number Patent -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số bằng</span>
                                </div>
                                <input type="text" name="registration_number" placeholder="Enter Number Patent"
                                    value="{{ old('registration_number', $patent->registration_number) }}"
                                    class="input input-bordered w-full @error('registration_number') border-red-500 @enderror" />
                                @error('registration_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp</span>
                                </div>
                                <input type="date" name="registration_date" placeholder="Select Patent Date"
                                    value="{{ old('registration_date', $patent->registration_date ? \Carbon\Carbon::parse($patent->registration_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('registration_date') border-red-500 @enderror" />
                                @error('registration_date')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Out of Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn bằng</span>
                                </div>
                                <input type="date" name="expiration_date" placeholder="Select Patent Out of Date"
                                    value="{{ old('expiration_date', $patent->expiration_date ? \Carbon\Carbon::parse($patent->expiration_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('expiration_date') border-red-500 @enderror" />
                                @error('expiration_date')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <!-- Patent Status -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái bằng</span>
                                </div>
                                <select name="status"
                                    class="input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="Chờ chia đơn ND"
                                        {{ old('status', $patent->status) == 'Chờ chia đơn ND' ? 'selected' : '' }}>
                                        Chờ chia đơn ND
                                    </option>
                                    <option value="Chờ duyệt CV"
                                        {{ old('status', $patent->status) == 'Chờ duyệt CV' ? 'selected' : '' }}>
                                        Chờ duyệt CV
                                    </option>
                                    <option value="Chờ thẩm định nội dung"
                                        {{ old('status', $patent->status) == 'Chờ thẩm định nội dung' ? 'selected' : '' }}>
                                        Chờ thẩm định nội dung
                                    </option>
                                    <option value="Đã cập nhật Bản mô tả"
                                        {{ old('status', $patent->status) == 'Đã cập nhật Bản mô tả' ? 'selected' : '' }}>
                                        Đã cập nhật Bản mô tả
                                    </option>
                                    <option value="Đã công bố"
                                        {{ old('status', $patent->status) == 'Đã công bố' ? 'selected' : '' }}>
                                        Đã công bố
                                    </option>
                                    <option value="Hết hạn hiệu lực VBBH"
                                        {{ old('status', $patent->status) == 'Hết hạn hiệu lực VBBH' ? 'selected' : '' }}>
                                        Hết hạn hiệu lực VBBH
                                    </option>
                                    <option value="Từ chối cấp VBBH"
                                        {{ old('status', $patent->status) == 'Từ chối cấp VBBH' ? 'selected' : '' }}>
                                        Từ chối cấp VBBH
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                                <small class="text-red-500 text-left">{{ $message }}</small>
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
                                <small class="text-red-500 text-left">{{ $message }}</small>
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
        <x-admin.forms.tinymce-config column="abstract" model="Patent" />
        {{-- Get communes based on district --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const MAX_FILE_SIZE = 10 (*) 1024 (*) 1024; // 10MB

                // Kiểm tra kích thước tài liệu
                document.getElementById('documents').addEventListener('change', function(event) {
                    const files = event.target.files;
                    const preview = document.getElementById('documents-preview');
                    preview.innerHTML = ''; // Xóa nội dung cũ

                    Array.from(files).forEach(file => {
                        if (file.size > MAX_FILE_SIZE) {
                            alert(`Tệp ${file.name} vượt quá kích thước tối đa 10MB.`);
                            event.target.value = ''; // Xóa tệp đã chọn
                            return;
                        }
                        const fileElement = document.createElement('div');
                        fileElement.textContent = file.name; // Hiển thị tên tệp

                        preview.appendChild(fileElement);
                    });
                });

                // Kiểm tra kích thước hình ảnh
                document.getElementById('images').addEventListener('change', function(event) {
                    const files = event.target.files;
                    const preview = document.getElementById('images-preview');

                    // Tạo một mảng để chứa các phần tử hình ảnh
                    const imageElements = [];

                    Array.from(files).forEach(file => {
                        if (file.size > MAX_FILE_SIZE) {
                            alert(`Hình ảnh ${file.name} vượt quá kích thước tối đa 10MB.`);
                            event.target.value = ''; // Xóa hình ảnh đã chọn
                            return;
                        }
                        if (file.type.startsWith('image/')) {
                            const imgElement = document.createElement('img');
                            imgElement.src = URL.createObjectURL(file);
                            imgElement.style.maxWidth = '150px';
                            imgElement.style.borderRadius = '18px';
                            imgElement.style.padding = '10px'; // Padding cho ảnh
                            imgElement.alt = file.name;

                            // Tạo một container cho ảnh và thêm vào danh sách
                            const imageContainer = document.createElement('div');
                            imageContainer.className =
                                'flex justify-center items-center'; // Center the image
                            imageContainer.appendChild(imgElement);

                            // Thêm phần tử vào đầu mảng
                            imageElements.unshift(imageContainer);
                        }
                    });

                    // Xóa các ảnh hiện tại trong preview
                    preview.innerHTML = '';

                    // Cập nhật preview với các ảnh đã sắp xếp
                    imageElements.forEach((element) => {
                        preview.appendChild(element);
                    });

                    // Xác định số cột cho lưới
                    const numberOfRows = Math.ceil(imageElements.length / 2);
                    preview.className = `grid grid-cols-${numberOfRows} gap-4 mt-4`;
                });
            });
        </script>

        {{-- lấy toạ độ  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbbI-IH80_-AgZbiq1lKAkcOoavIWTEc&callback=initMap"></script>
        <script src='{{ asset('adminpage/map/getlocation_edit.js') }}'></script>
    @endpushonce

</x-admin-layout>
