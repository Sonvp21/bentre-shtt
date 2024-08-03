<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.industrial_designs.index') }}">Danh sách kiểu dáng</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.industrial_designs.update', $industrialDesign) }}" method="POST"
                enctype="multipart/form-data">
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
                                    @foreach ($industrialDesignType as $industrialDesign_type)
                                        <option value="{{ $industrialDesign_type->id }}"
                                            {{ old('type_id', $industrialDesign->type_id) == $industrialDesign_type->id ? 'selected' : '' }}>
                                            {{ $industrialDesign_type->name }}
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
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $industrialDesign->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Chủ kiểu dáng</span>
                                </div>
                                <input type="text" name="owner" placeholder="Nhập vào"
                                    value="{{ old('owner', $industrialDesign->owner) }}"
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
                                    class="form-textarea input input-bordered w-full @error('description') border-red-500 @enderror" rows="4">{{ old('description', $industrialDesign->description) }}</textarea>
                                @error('description')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ</span>
                                </div>
                                <input type="text" name="address" placeholder="Nhập vào"
                                    value="{{ old('address', $industrialDesign->address) }}"
                                    class="input input-bordered w-full {{ $errors->has('address') ? 'input-error' : '' }}" />
                                @error('address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <!-- Tệp đính kèm -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tệp đính kèm</span>
                                </div>
                                <input type="file" id="documents" name="documents[]" multiple
                                    accept=".pdf, .doc, .docx"
                                    class="input input-bordered w-full {{ $errors->has('documents') ? 'input-error' : '' }}" />
                                @error('documents')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="documents-preview">
                                    @foreach ($industrialDesign->documents as $document)
                                        <div>{{ $document->file_name }}</div>
                                    @endforeach
                                </div>
                            </label>

                            <!-- Ảnh -->
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ảnh</span>
                                </div>
                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    class="input input-bordered w-full {{ $errors->has('images') ? 'input-error' : '' }}" />
                                @error('images')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                                <div id="images-preview">
                                    @foreach ($industrialDesign->images as $image)
                                        <img src="{{ asset('storage/' . $image->file_path) }}"
                                            style="max-width: 150px; margin-right: 10px;"
                                            alt="{{ $image->file_name }}">
                                    @endforeach
                                </div>
                            </label>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('documents').addEventListener('change', function(event) {
                                        const files = event.target.files;
                                        const preview = document.getElementById('documents-preview');
                                        preview.innerHTML = ''; // Xóa nội dung cũ
                            
                                        Array.from(files).forEach(file => {
                                            // Hiển thị tên tất cả các tệp đính kèm
                                            const fileElement = document.createElement('div');
                                            fileElement.textContent = file.name;
                                            preview.appendChild(fileElement);
                                        });
                                    });
                            
                                    document.getElementById('images').addEventListener('change', function(event) {
                                        const files = event.target.files;
                                        const preview = document.getElementById('images-preview');
                                        preview.innerHTML = ''; // Xóa nội dung cũ
                            
                                        Array.from(files).forEach(file => {
                                            if (file.type.startsWith('image/')) {
                                                const imgElement = document.createElement('img');
                                                imgElement.src = URL.createObjectURL(file);
                                                imgElement.style.maxWidth = '150px'; // Giới hạn kích thước ảnh
                                                imgElement.style.marginRight = '10px';
                                                imgElement.alt = file.name;
                                                preview.appendChild(imgElement);
                                            } else {
                                                console.warn('Tệp không phải ảnh:', file.name);
                                            }
                                        });
                                    });
                                });
                            </script>
                            

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
                                            {{ old('district_id', $industrialDesign->district_id) == $district->id ? 'selected' : '' }}>
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
                                            {{ old('commune_id', $industrialDesign->commune_id) == $commune->id ? 'selected' : '' }}>
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
                                    value="{{ old('application_number', $industrialDesign->application_number) }}"
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
                                    value="{{ old('submission_date', $industrialDesign->submission_date ? \Carbon\Carbon::parse($industrialDesign->submission_date)->format('Y-m-d') : '') }}"
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
                                        {{ old('submission_status', $industrialDesign->submission_status) == '1' ? 'selected' : '' }}>
                                        Đang xử lý</option>
                                    <option value="2"
                                        {{ old('submission_status', $industrialDesign->submission_status) == '2' ? 'selected' : '' }}>
                                        Đã
                                        cấp</option>
                                    <option value="3"
                                        {{ old('submission_status', $industrialDesign->submission_status) == '3' ? 'selected' : '' }}>
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
                                    value="{{ old('publication_date', $industrialDesign->publication_date ? \Carbon\Carbon::parse($industrialDesign->publication_date)->format('Y-m-d') : '') }}"
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
                                    value="{{ old('publication_number', $industrialDesign->publication_number) }}"
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
                                    value="{{ old('design_date', $industrialDesign->design_date ? \Carbon\Carbon::parse($industrialDesign->design_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('design_date') border-red-500 @enderror" />
                                @error('design_date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày hết hạn</span>
                                </div>
                                <input type="date" name="out_of_date"
                                    placeholder="Select industrialDesign Out of Date"
                                    value="{{ old('out_of_date', $industrialDesign->out_of_date ? \Carbon\Carbon::parse($industrialDesign->out_of_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('out_of_date') border-red-500 @enderror" />
                                @error('out_of_date')
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
                                    <option value="1"
                                        {{ old('design_status', $industrialDesign->design_status) == '1' ? 'selected' : '' }}>
                                        Hiệu lực</option>
                                    <option value="2"
                                        {{ old('design_status', $industrialDesign->design_status) == '2' ? 'selected' : '' }}>
                                        Hết hạn</option>
                                    <option value="3"
                                        {{ old('design_status', $industrialDesign->design_status) == '3' ? 'selected' : '' }}>
                                        Bị huỷ</option>
                                </select>
                                @error('design_status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                        </div>
                    </div>
                </div>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('admin.industrial_designs.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
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


    @endpushonce

</x-admin-layout>
