<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <div class="text-gray-800 text-sm font-semibold leading-tight flex">
            <span class="text-gray-800 text-sm flex items-center gap-2 font-semibold leading-tight">
                Danh sách
            </span>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5 p-3 text-sm">
            <div class="overflow-x-auto">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Form upload -->
                            <form action="{{ route('image.search') }}" method="POST" enctype="multipart/form-data"
                                id="uploadForm" class="flex">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Chọn ảnh để tải lên:</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                </div>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Tải lên và Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="row">
                            @if (!empty($similarImages) && count($similarImages) > 0)
                                @if (Session::has('uploaded_image_path'))
                                    <h2>Ảnh đã tải lên:</h2>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div>
                                            @php
                                                $path = Session::get('uploaded_image_path');
                                                $url = asset('storage/' . $path);
                                            @endphp
                                            <img src="{{ $url }}" class="img-fluid mt-3" alt="Uploaded Image">
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    @if (!empty($similarImages) && count($similarImages) > 0)
                                        <h2 class="mt-5">Các ảnh tương đồng:</h2>
                                        <div class="grid grid-cols-4 gap-4">
                                            @foreach ($similarImages as $index => $similarImage)
                                                <div class="relative">
                                                    <p class="text-center mb-2">{{ $similarImage['product']->name }}</p>
                                                    <img src="{{ $similarImage['image']->getUrl() }}" class="img-fluid" alt="Similar Image">
                                                    <p class="absolute bottom-0 left-0 w-full bg-white bg-opacity-75 text-center py-2">
                                                        Độ tương đồng: {{ $similarImage['similarity'] }}
                                                    </p>
                                                    @if ($index >= 4) <!-- Chỉ hiển thị từ hàng thứ 2 -->
                                                        <div class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                                                            <button
                                                                class="text-blue-500 font-semibold hover:underline"
                                                                onclick="this.parentElement.classList.add('hidden');"
                                                            >
                                                                Xem thêm
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p>Không tìm thấy ảnh tương tự.</p>
                                    @endif
                                </div>
                                
                            @else
                                <p>Không tìm thấy ảnh tương tự.</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
