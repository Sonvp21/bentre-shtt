<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.advisory_supports.index') }}">Danh sách thông tin hỗ trợ, tư vấn</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.advisory_supports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">

                            <label for="parent_id" class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">Danh mục tài liệu</span>
                                </div>
                                <select id="parent_id" name="parent_id"
                                    class="!max-h-11 !min-h-0 select select-bordered ">
                                    <option value="" disabled selected>Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tiêu đề</span>
                                </div>
                                <input type="text" name="title" placeholder="Nhập vào" value="{{ old('title') }}"
                                    class="input input-bordered w-full {{ $errors->has('title') ? 'input-error' : '' }}" />
                                @error('title')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">@lang('admin.content')</span>
                                </div>
                                <textarea name="content" id="content"
                                    class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('content') ? 'input-error' : '' }}"
                                    rows="1">{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">Ghi chú</span>
                                </div>
                                <textarea name="status" id="status"
                                    class="textarea textarea-bordered h-12 @error('status') border-red-500 @enderror" placeholder="...">{{ old('status') }}</textarea>
                                @error('status')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày đăng</span>
                                </div>
                                <input type="date" name="published_at" placeholder="Select Submission Date"
                                    value="{{ old('published_at') }}"
                                    class="input input-bordered w-full @error('published_at') border-red-500 @enderror" />
                                @error('published_at')
                                    <small class="text-red-500">{{ $message }}</small>
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
                                <div class="shrink-0 mt-5">
                                    <img id="preview_img" class="h-56 w-50 rounded-md object-cover"
                                        src="{{ asset('adminpage/image/image_default.png') }}" alt="Current photo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center pb-3 pt-5"><button type="submit"
                        class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    <a href="{{ route('admin.advisory_supports.index') }}"
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
    @endpushonce

</x-admin-layout>
