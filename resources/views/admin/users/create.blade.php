<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            
                <ul>
                    <li><a href="{{ route('admin.users.index') }}">Danh sách tài khoản</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

                <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-flow-row-dense grid-cols-4 grid-rows-1 ...">
                        {{-- cột 1 --}}
                        <div class="col-span-1">
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
                                    <span class="text-sm font-medium text-gray-700">Số điện thoại</span>
                                </div>
                                <input type="text" name="phone" placeholder="09987..." value="{{ old('phone') }}"
                                    class="input input-bordered w-full {{ $errors->has('phone') ? 'input-error' : '' }}" />
                                @error('phone')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Địa chỉ chi tiết</span>
                                </div>
                                <input type="text" name="address" placeholder="vd: thôn...xã..."
                                    value="{{ old('address') }}"
                                    class="input input-bordered w-full {{ $errors->has('address') ? 'input-error' : '' }}" />
                                @error('address')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Sinh nhật </span>
                                </div>
                                <input type="date" name="birthday" placeholder="vd: 22/09/1987"
                                    value="{{ old('birthday') }}"
                                    class="input input-bordered w-full {{ $errors->has('birthday') ? 'input-error' : '' }}" />
                                @error('birthday')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        {{-- Cột 2 --}}
                        <div class="col-span-1">
                            {{-- <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Vai trò</span>
                                </div>
                                <select name="category_id" id="category_id"
                                    class="input input-bordered w-full @error('category_id') border-red-500 @enderror">
                                    <option value="">Chọn category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label> --}}

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Vai trò</span>
                                </div>
                                <select name="role_id[]"
                                    class="input input-bordered w-full @error('role_id') border-red-500 @enderror">
                                    <option value="">Chọn vai trò</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ $role->display_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên người dùng</span>
                                </div>
                                <input type="text" name="name" placeholder="..." value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên đầy đủ</span>
                                </div>
                                <input type="text" name="full_name" placeholder="Nguyễn Văn A"
                                    value="{{ old('full_name') }}"
                                    class="input input-bordered w-full {{ $errors->has('full_name') ? 'input-error' : '' }}" />
                                @error('full_name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Email</span>
                                </div>
                                <input type="text" name="email" placeholder="vd: abc@gmail.com" autocomplete
                                    value="{{ old('email') }}"
                                    class="input input-bordered w-full {{ $errors->has('email') ? 'input-error' : '' }}" />
                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>


                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Mật khẩu</span>
                                </div>
                                <input type="password" name="password" placeholder="password"
                                    value="{{ old('password') }}" autocomplete="new-password"
                                    class="input input-bordered w-full {{ $errors->has('password') ? 'input-error' : '' }}" />
                                @error('password')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                        </div>
                        {{-- Cột 3 --}}
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status"
                                    class="input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="0"
                                        {{ old('status', $user->status ?? '') == 0 ? 'selected' : '' }}>Không kích hoạt
                                    </option>
                                    <option value="1"
                                        {{ old('status', $user->status ?? '') == 1 ? 'selected' : '' }}>Kích hoạt
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Mô tả</span>
                                </div>
                                <textarea name="description" id="description" class="textarea textarea-bordered"></textarea>
                                @error('description')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <div class="items-center form-group">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hình ảnh</span>
                                </div>

                                <div id="dropArea" class="drop-area">
                                    <label for="imageInput">
                                        <div class="text-gray-600"><i class="far fa-images"></i>
                                            <p class="mb-2">Kéo thả tập tin của bạn vào đây hoặc
                                                <a class="text-teal-600 cursor-pointer">duyệt tập tin</a>
                                                để chọn tập tin.
                                            </p>
                                        </div>
                                    </label>

                                </div>

                                <input type="file" id="imageInput" name="images[]" multiple accept="image/*"
                                    data-max-file-size="3MB" data-max-files="3" style="display: none;" />

                                <div id="imagePreview" class="mt-5 gap-3 text-center"></div>

                                @error('images')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div class="flex gap-4 justify-center pb-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    </div>
                </form>

        </div>
    </div>

    @pushonce('bottom_scripts')
        {{-- lấy xã theo huyện  --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropArea = document.getElementById('dropArea');
                const imageInput = document.getElementById('imageInput');
                const imagePreview = document.getElementById('imagePreview');
                let selectedFiles = [];

                if (dropArea && imagePreview) {
                    dropArea.addEventListener('dragover', function(event) {
                        event.preventDefault();
                        dropArea.classList.add('border-teal-600');
                    });

                    dropArea.addEventListener('dragleave', function(event) {
                        event.preventDefault();
                        dropArea.classList.remove('border-teal-600');
                    });

                    dropArea.addEventListener('drop', function(event) {
                        event.preventDefault();
                        dropArea.classList.remove('border-teal-600');
                        selectedFiles = Array.from(event.dataTransfer.files);
                        updateImagePreview();
                    });
                }
                if (imageInput && imagePreview) {
                    imageInput.addEventListener('change', function() {
                        selectedFiles = Array.from(this.files);

                        // Hiển thị preview
                        updateImagePreview();
                    });
                }

                function updateImagePreview() {
                    imagePreview.innerHTML = '';
                    selectedFiles.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const imgElement = document.createElement('div');
                            imgElement.classList.add('relative', 'image-preview');

                            const deleteButton = document.createElement('button');
                            deleteButton.innerHTML = '&times;';
                            deleteButton.classList.add('absolute', 'top-0', 'right-0', 'cursor-pointer',
                                'text-white', 'bg-red-500', 'rounded-full', 'p-1', 'shadow',
                                'delete-image');
                            deleteButton.addEventListener('click', function() {
                                selectedFiles.splice(index, 1);
                                updateImagePreview();
                                updateImageInputFiles(); // Cập nhật input files sau khi xóa
                            });

                            const img = document.createElement('img');
                            img.src = event.target.result;
                            img.classList.add('max-w-full', 'max-h-32', 'object-contain');

                            imgElement.appendChild(img);
                            imgElement.appendChild(deleteButton);
                            imagePreview.appendChild(imgElement);
                        };
                        reader.readAsDataURL(file);
                    });
                }

                function updateImageInputFiles() {
                    // Create a new DataTransfer object
                    const dataTransfer = new DataTransfer();
                    selectedFiles.forEach(file => dataTransfer.items.add(file));

                    // Update the input files with the new DataTransfer object
                    imageInput.files = dataTransfer.files;
                }

                // Update input files before form submission
                const form = imageInput.closest('form');
                form.addEventListener('submit', function(event) {
                    updateImageInputFiles(); // Ensure the input files are updated before form submission
                });
            });
        </script>


        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>
    @endpushonce


</x-admin-layout>
