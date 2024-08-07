<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.trademarks.index') }}">Danh sách nhãn hiệu</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.trademarks.update', $trademark) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- Column 1 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Nhóm ngành</span>
                                </div>
                                <select name="type_id" id="type_id"
                                    class="input input-bordered w-full @error('type_id') border-red-500 @enderror">
                                    <option value="">Chọn nhóm ngành</option>
                                    @foreach ($trademark_types as $trademark_type)
                                        <option value="{{ $trademark_type->id }}"
                                            {{ old('type_id', $trademark->type_id) == $trademark_type->id ? 'selected' : '' }}>
                                            {{ $trademark_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên nhãn hiệu</span>
                                </div>
                                <input type="text" name="mark" placeholder="Nhập vào"
                                    value="{{ old('mark', $trademark->mark) }}"
                                    class="input input-bordered w-full {{ $errors->has('mark') ? 'input-error' : '' }}" />
                                @error('mark')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Màu sắc nhãn hiệu</span>
                                </div>
                                <input type="text" name="mark_colors" placeholder="..." value="{{ old('mark_colors', $trademark->mark_colors) }}"
                                    class="input input-bordered w-full {{ $errors->has('mark_colors') ? 'input-error' : '' }}" />
                                @error('mark_colors')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Kiểu mẫu</span>
                                </div>
                                <select name="mark_feature"
                                    class="input input-bordered w-full @error('mark_feature') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="Hình ảnh" {{ old('mark_feature', $trademark->mark_feature) == 'Hình ảnh' ? 'selected' : '' }}>
                                        Hình ảnh</option>
                                    <option value="Chữ viết" {{ old('mark_feature', $trademark->mark_feature) == 'Chữ viết' ? 'selected' : '' }}>
                                        Chữ viết
                                    </option>
                                    <option value="Kết hợp" {{ old('mark_feature', $trademark->mark_feature) == 'Kết hợp' ? 'selected' : '' }}>
                                        Kết hợp
                                    </option>
                                </select>
                                @error('mark_feature')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Phân loại hình</span>
                                </div>
                                <input type="text" name="vienna_classes" placeholder="vd: 26.13.25 (7)"
                                    value="{{ old('vienna_classes', $trademark->vienna_classes) }}"
                                    class="input input-bordered w-full {{ $errors->has('vienna_classes') ? 'input-error' : '' }}" />
                                @error('vienna_classes')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Yếu tố loại trừ</span>
                                </div>
                                <input type="text" name="disclaimer"
                                    placeholder="vd: Nhãn hiệu được bảo hộ tổng thể | Không bảo hộ riêng: ...."
                                    value="{{ old('disclaimer', $trademark->disclaimer) }}"
                                    class="input input-bordered w-full {{ $errors->has('disclaimer') ? 'input-error' : '' }}" />
                                @error('disclaimer')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ nhãn hiệu</span>
                                </div>
                                <input type="text" name="owner"
                                    value="{{ old('owner', $trademark->owner) }}"
                                    class="input input-bordered w-full {{ $errors->has('owner') ? 'input-error' : '' }}" />
                                @error('owner')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ</span>
                                </div>
                                <input type="text" name="address" placeholder="Nhập vào"
                                    value="{{ old('address', $trademark->address) }}"
                                    class="input input-bordered w-full {{ $errors->has('address') ? 'input-error' : '' }}" />
                                @error('address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ nhãn hiệu khác</span>
                                </div>
                                <input type="text" name="other_owner"
                                    placeholder="vd: Kẹo dừa Ngân Phát-Tổ NDTQ số .., ấp..., xã ..., huyện ..., tỉnh Bến Tre"
                                    value="{{ old('other_owner', $trademark->other_owner) }}"
                                    class="input input-bordered w-full {{ $errors->has('other_owner') ? 'input-error' : '' }}" />
                                @error('other_owner')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đại diện pháp luật</span>
                                </div>
                                <input type="text" name="representative_name" placeholder="Nguyễn Văn A"
                                    value="{{ old('representative_name', $trademark->representative_name) }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_name') ? 'input-error' : '' }}" />
                                @error('representative_name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ đại diện pháp luật</span>
                                </div>
                                <input type="text" name="representative_address" placeholder="Nhập địa chỉ"
                                    value="{{ old('representative_address', $trademark->representative_address) }}"
                                    class="input input-bordered w-full {{ $errors->has('representative_address') ? 'input-error' : '' }}" />
                                @error('representative_address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
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
                                <div id="documents-preview">
                                    @foreach ($trademark->documents as $document)
                                        <div>{{ $document->file_name }}</div>
                                    @endforeach
                                </div>
                            </label>

                            <!-- Ảnh -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ảnh (tối đa 10MB)</span>
                                </div>
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="file-input file-input-bordered file-input-sm w-full max-w-xs {{ $errors->has('images') ? 'input-error' : '' }}" />
                                @error('images')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="images-preview" class="grid grid-cols-2 gap-4 mt-4">
                                    @foreach ($trademark->images as $image)
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
                                            {{ old('district_id', $trademark->district_id) == $district->id ? 'selected' : '' }}>
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
                                            {{ old('commune_id', $trademark->commune_id) == $commune->id ? 'selected' : '' }}>
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
                                    <span class="text-sm font-medium text-gray-700">Loại đơn</span>
                                </div>
                                <select name="application_type"
                                    class="input input-bordered w-full @error('application_type') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="Thông thường"
                                        {{ old('application_type', $trademark->application_type) == 'Thông thường' ? 'selected' : '' }}>
                                        Thông thường</option>
                                    <option value="Tập thể"
                                        {{ old('application_type', $trademark->application_type) == 'Tập thể' ? 'selected' : '' }}>
                                        Tập thể
                                    </option>
                                    <option value="Chứng nhận"
                                        {{ old('application_type', $trademark->application_type) == 'Chứng nhận' ? 'selected' : '' }}>
                                        Chứng nhận
                                    </option>
                                </select>
                                @error('application_type')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn</span>
                                </div>
                                <input type="text" name="filing_number" placeholder="Nhập vào"
                                    value="{{ old('filing_number', $trademark->filing_number) }}"
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
                                    value="{{ old('filing_date', $trademark->filing_date ? \Carbon\Carbon::parse($trademark->filing_date)->format('Y-m-d') : '') }}"
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
                                    value="{{ old('publication_number', $trademark->publication_number) }}"
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
                                    value="{{ old('publication_date', $trademark->publication_date ? \Carbon\Carbon::parse($trademark->publication_date)->format('Y-m-d') : '') }}"
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
                                    value="{{ old('registration_number', $trademark->registration_number) }}"
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
                                    value="{{ old('registration_date', $trademark->registration_date ? \Carbon\Carbon::parse($trademark->registration_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('registration_date') border-red-500 @enderror" />
                                @error('registration_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn</span>
                                </div>
                                <input type="date" name="expiration_date" placeholder="Select trademark Out of Date"
                                    value="{{ old('expiration_date', $trademark->expiration_date ? \Carbon\Carbon::parse($trademark->expiration_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('expiration_date') border-red-500 @enderror" />
                                @error('expiration_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status"
                                    class="input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="">Lựa chọn</option>
                                    <option value="Cấp bằng" {{ old('status' , $trademark->status) == 'Cấp bằng' ? 'selected' : '' }}>
                                        Cấp bằng
                                    </option>
                                    <option value="Đang giải quyết" {{ old('status' , $trademark->status) == 'Đang giải quyết' ? 'selected' : '' }}>
                                        Đang giải quyết
                                    </option>
                                    <option value="Hết hạn" {{ old('status', $trademark->status) == 'Hết hạn' ? 'selected' : '' }}>
                                        Hết hạn
                                    </option>
                                    <option value="Rút đơn" {{ old('status', $trademark->status) == 'Rút đơn' ? 'selected' : '' }}>
                                        Rút đơn
                                    </option>
                                    <option value="Từ bỏ" {{ old('status', $trademark->status) == 'Từ bỏ' ? 'selected' : '' }}>
                                        Từ bỏ
                                    </option>
                                    <option value="Từ chối" {{ old('status', $trademark->status) == 'Từ chối' ? 'selected' : '' }}>
                                        Từ chối
                                    </option>
                                </select>
                                @error('status')
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
                                value="{{ old('longitude', $trademark->getLongitude($trademark->id)) }}"
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
                                value="{{ old('latitude', $trademark->getLatitude($trademark->id)) }}"
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
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.trademarks.index') }}"
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
