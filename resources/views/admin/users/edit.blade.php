<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            
                <ul>
                    <li><a href="{{ route('admin.users.index') }}">Danh sách tài khoản</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="p-5 overflow-x-auto">
                <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Huyện</span>
                                </div>
                                <select name="district_id" id="district_id"
                                    class="input input-bordered w-full @error('district_id') border-red-500 @enderror">
                                    <option value="">Chọn huyện</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', $user->district_id) == $district->id ? 'selected' : '' }}>
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
                                            {{ old('commune_id', $user->commune_id) == $commune->id ? 'selected' : '' }}>
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
                                <input type="text" name="phone" placeholder="09987..."
                                    value="{{ old('phone', $user->phone) }}"
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
                                    value="{{ old('address', $user->address) }}"
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
                                    value="{{ old('birthday', $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}"
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
                                            {{ old('category_id', $user->category_id) == $category->id ? 'selected' : '' }}>
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
                                <select name="role_id"
                                    class="input input-bordered w-full @error('role_id') border-red-500 @enderror">
                                    <option value="">Chọn vai trò</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
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
                                <input type="text" name="name" placeholder="..."
                                    value="{{ old('name', $user->name) }}"
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
                                    value="{{ old('email', $user->email) }}"
                                    class="input input-bordered w-full {{ $errors->has('email') ? 'input-error' : '' }}" />
                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <div class="form-group mt-5">
                                <button type="button" id="change-password-toggle"
                                    class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Đổi mật khẩu</button>
                            </div>

                            <div id="password-fields" style="display: none;">
                                <label class="form-control w-[95%]">
                                    <div class="label">
                                        <span class="text-sm font-medium text-gray-700">Mật khẩu cũ</span>
                                    </div>
                                    <input type="password" name="current_password" placeholder="Current password"
                                        class="input input-bordered w-full @error('current_password') input-error @enderror" />
                                    @error('current_password')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label class="form-control w-[95%]">
                                    <div class="label">
                                        <span class="text-sm font-medium text-gray-700">Mật khẩu mới</span>
                                    </div>
                                    <input type="password" name="password" placeholder="New password"
                                        class="input input-bordered w-full @error('password') input-error @enderror" />
                                    @error('password')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>

                                <label class="form-control w-[95%]">
                                    <div class="label">
                                        <span class="text-sm font-medium text-gray-700">Xác nhận mật khẩu mới</span>
                                    </div>
                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirm new password"
                                        class="input input-bordered w-full @error('password_confirmation') input-error @enderror" />
                                    @error('password_confirmation')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>

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
                                <textarea name="description" id="description" class="textarea textarea-bordered">{{ old('user', $user->description) }}</textarea>
                                @error('description')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <div class="form-group">
                                <label for="images">Hình ảnh</label>

                                <div id="drop-area" class="drop-area">
                                    <i class="far fa-images fa-3x mb-3 text-muted"></i>
                                    <br>
                                    <span class="drop-text">Kéo thả tập tin vào đây hoặc <a href="#"
                                            id="browse-link">duyệt tập tin</a></span>
                                </div>

                                <input type="file" id="images" name="images[]" multiple accept="image/*"
                                    style="display: none;">

                                @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div id="current_images" class="text-center">
                                    <!-- Hiển thị các ảnh hiện tại của user -->
                                    @foreach ($user->getMedia('user_images') as $media)
                                        <div class="image-preview">
                                            <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}"
                                                class="img-thumbnail">
                                            <button type="button" class="btn btn-sm btn-danger delete-image"
                                                data-media-id="{{ $media->id }}">Xóa</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Xử lý sự kiện click vào vùng kéo thả hoặc link duyệt tập tin
                                    const dropArea = document.getElementById('drop-area');
                                    const browseLink = document.getElementById('browse-link');
                                    const imageInput = document.getElementById('images');

                                    dropArea.addEventListener('click', function() {
                                        imageInput.click(); // Kích hoạt sự kiện click cho input file khi click vào drop area
                                    });

                                    browseLink.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        imageInput
                                            .click(); // Kích hoạt sự kiện click cho input file khi click vào link duyệt tập tin
                                    });

                                    // Xử lý sự kiện khi chọn ảnh mới từ input file
                                    imageInput.addEventListener('change', function() {
                                        const selectedImages = document.getElementById('current_images');

                                        // Lặp qua từng file được chọn từ input file
                                        Array.from(this.files).forEach(file => {
                                            const reader = new FileReader();
                                            reader.onload = function(event) {
                                                const imgElement = document.createElement('div');
                                                imgElement.classList.add('image-preview');
                                                imgElement.innerHTML = `
                                    <img src="${event.target.result}" class="img-thumbnail" alt="${file.name}">
                                    <button type="button" class="btn btn-sm btn-danger delete-image">Xóa</button>
                                    `;
                                                selectedImages.appendChild(
                                                    imgElement); // Thêm ảnh mới vào cuối danh sách

                                                // Xử lý sự kiện xóa ảnh mới
                                                imgElement.querySelector('.delete-image').addEventListener('click',
                                                    function() {
                                                        imgElement
                                                            .remove(); // Xóa phần tử ảnh khi click vào nút xóa
                                                    });
                                            };
                                            reader.readAsDataURL(file); // Đọc dữ liệu của file ảnh
                                        });
                                    });


                                    // Xử lý sự kiện xóa ảnh
                                    document.querySelectorAll('.delete-image').forEach(button => {
                                        button.addEventListener('click', function() {
                                            const mediaId = this.getAttribute('data-media-id');
                                            // Gửi request xóa media sử dụng Ajax
                                            fetch(`/admin/users/${mediaId}/delete-media`, {
                                                    method: 'DELETE',
                                                    headers: {
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                        'Content-Type': 'application/json'
                                                    },
                                                })
                                                .then(response => {
                                                    if (response.ok) {
                                                        // Xóa phần tử khỏi DOM
                                                        this.closest('.image-preview').remove();
                                                    }
                                                })
                                                .catch(error => console.error('Error:', error));
                                        });
                                    });
                                });
                            </script>


                        </div>

                        <div class="flex gap-4 justify-center p-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                            <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                        </div>
                </form>
            </div>
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
            document.getElementById('change-password-toggle').addEventListener('click', function() {
                var passwordFields = document.getElementById('password-fields');
                if (passwordFields.style.display === 'none') {
                    passwordFields.style.display = 'block';
                } else {
                    passwordFields.style.display = 'none';
                }
            });
        </script>
    @endpushonce


</x-admin-layout>
