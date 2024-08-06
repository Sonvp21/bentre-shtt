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
                                    <span class="text-sm font-medium text-gray-700">
                                        Tên kiểu dáng <span class="text-red-500">(*)</span></span>
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
                                <input type="text" name="owner" placeholder="..." value="{{ old('owner') }}"
                                    class="input input-bordered w-full {{ $errors->has('owner') ? 'input-error' : '' }}" />
                                @error('owner')
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

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Người thiết kế</span>
                                </div>
                                <input type="text" name="designer" placeholder="Nhập địa chỉ"
                                    value="{{ old('designer') }}"
                                    class="input input-bordered w-full {{ $errors->has('designer') ? 'input-error' : '' }}" />
                                @error('designer')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ người thiết kế</span>
                                </div>
                                <input type="text" name="designer_address" placeholder="Nhập địa chỉ"
                                    value="{{ old('designer_address') }}"
                                    class="input input-bordered w-full {{ $errors->has('designer_address') ? 'input-error' : '' }}" />
                                @error('designer_address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>


                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đại diện pháp luật</span>
                                </div>
                                <input type="text" name="representative_name" placeholder="Nhập địa chỉ"
                                    value="{{ old('representative_name') }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_name') ? 'input-error' : '' }}" />
                                @error('representative_name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ Đại diện pháp luật</span>
                                </div>
                                <input type="text" name="representative_address" placeholder="Nhập địa chỉ"
                                    value="{{ old('representative_address') }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_address') ? 'input-error' : '' }}" />
                                @error('representative_address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">Mô tả</span>
                                </div>
                                <textarea name="description" id="description"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('description') ? 'input-error' : '' }}"
                                    rows="1">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
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
                                    <span class="text-sm font-medium text-gray-700">
                                        Số đơn gốc <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="filing_number" placeholder="Nhập vào"
                                    value="{{ old('filing_number') }}"
                                    class="input input-bordered w-full {{ $errors->has('filing_number') ? 'input-error' : '' }}" />
                                @error('filing_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày nộp đơn</span>
                                </div>
                                <input type="date" name="filing_date" placeholder="Select Submission Date"
                                    value="{{ old('filing_date') }}"
                                    class="input input-bordered w-full @error('filing_date') border-red-500 @enderror" />
                                @error('filing_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>


                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số công bố</span>
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
                                    <span class="text-sm font-medium text-gray-700">Số bằng</span>
                                </div>
                                <input type="text" name="registration_number" placeholder="Nhập vào"
                                    value="{{ old('registration_number') }}"
                                    class="input input-bordered w-full {{ $errors->has('registration_number') ? 'input-error' : '' }}" />
                                @error('registration_number')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp bằng</span>
                                </div>
                                <input type="date" name="registration_date" placeholder="Select Publication Date"
                                    value="{{ old('registration_date') }}"
                                    class="input input-bordered w-full @error('registration_date') border-red-500 @enderror" />
                                @error('registration_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <!--  Out of Date -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn</span>
                                </div>
                                <input type="date" name="expiration_date" placeholder="Select Patent Out of Date"
                                    value="{{ old('expiration_date') }}"
                                    class="input input-bordered w-full @error('expiration_date') border-red-500 @enderror" />
                                @error('expiration_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Phân loại locarno</span>
                                </div>
                                <input type="text" name="locarno_classes" placeholder="Nhập địa chỉ"
                                    value="{{ old('locarno_classes') }}"
                                    class="input input-bordered w-full {{ $errors->has('locarno_classes') ? 'input-error' : '' }}" />
                                @error('locarno_classes')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status"
                                    class="input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="Hết hạn" {{ old('status') == 'Hết hạn' ? 'selected' : '' }}>Hết hạn
                                    </option>
                                    <option value="Đã cấp phép"
                                        {{ old('status') == 'Đã cấp phép' ? 'selected' : '' }}>Đã cấp phép</option>
                                    <option value="Đang chờ xử lý"
                                        {{ old('status') == 'Đang chờ xử lý' ? 'selected' : '' }}>Đang chờ xử lý
                                    </option>
                                    <option value="Bị từ chối" {{ old('status') == 'Bị từ chối' ? 'selected' : '' }}>
                                        Bị từ chối</option>
                                    <option value="Đã rút lại" {{ old('status') == 'Đã rút lại' ? 'selected' : '' }}>
                                        Đã rút lại</option>
                                </select>
                                @error('status')
                                    <small class="text-red-500">{{ $message }}</small>
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
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="documents-preview"></div>
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ảnh (tối đa 10MB) </span>
                                </div>
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="file-input file-input-bordered file-input-sm w-full max-w-xs {{ $errors->has('images') ? 'input-error' : '' }}" />
                                @error('images')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="images-preview" class="grid grid-cols-1 gap-4 mt-4"></div>
                            </label>

                        </div>
                        <!-- Tọa độ -->
                        <label class="form-control w-[95%]">
                            <div class="label">
                                <span class="text-sm font-medium text-gray-700">Kinh độ</span>
                            </div>
                            <input type="text" id="longitude" name="longitude" placeholder="Nhập kinh độ"
                                value=""
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
                                value=""
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
                <div class="flex gap-4 justify-center m-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.industrial_designs.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>
            </form>

        </div>
    </div>

    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="description" model="IndustrialDesign" />
        {{-- lấy xã theo huyện  --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB

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
                    preview.innerHTML = ''; // Xóa nội dung cũ

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
                            imgElement.style.maxWidth = '160px';
                            imgElement.style.borderRadius = '20px';
                            imgElement.style.padding = '10px'; // Padding cho ảnh
                            imgElement.alt = file.name;

                            // Tạo một container cho ảnh và thêm vào danh sách
                            const imageContainer = document.createElement('div');
                            imageContainer.className =
                                'flex justify-center items-center'; // Center the image
                            imageContainer.appendChild(imgElement);
                            imageElements.unshift(imageContainer); // Thêm vào đầu danh sách
                        }
                    });

                    // Cập nhật preview với các ảnh đã sắp xếp
                    imageElements.forEach((element, index) => {
                        preview.appendChild(element);
                    });

                    // Xác định số cột cho lưới
                    const numberOfRows = Math.ceil(imageElements.length / 2);
                    preview.className = `grid grid-cols-${numberOfRows} gap-4 mt-4`;
                });
            });
        </script>
        {{-- lấy toạ độ create --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbbI-IH80_-AgZbiq1lKAkcOoavIWTEc&callback=initMap"></script>
        <script src='{{ asset('adminpage/map/getlocation_create.js') }}'></script>

    @endpushonce

</x-admin-layout>
