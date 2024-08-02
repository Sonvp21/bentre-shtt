<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.advisory_supports.index') }}">Danh sách thông tin hỗ trợ, tư vấn</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.advisory_supports.update', $advisorySupport->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                                        <option value="{{ $category->id }}"
                                            {{ $advisorySupport->parent_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tiêu đề</span>
                                </div>
                                <input type="text" name="title" placeholder="Nhập vào"
                                    value="{{ old('title', $advisorySupport->title) }}"
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
                                    rows="1">{{ old('content', $advisorySupport->content) }}</textarea>
                                @error('content')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">Ghi chú</span>
                                </div>
                                <textarea name="status" id="status"
                                    class="textarea textarea-bordered h-12 @error('status') border-red-500 @enderror" placeholder="...">{{ old('status', $advisorySupport->status) }}</textarea>
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
                                    value="{{ old('published_at', $advisorySupport->published_at ? \Carbon\Carbon::parse($advisorySupport->published_at)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('published_at') border-red-500 @enderror" />
                                @error('published_at')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Document</span>
                                </div>
                                @if ($advisorySupport->hasMedia('document_support'))
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tệp hiện tại:</span>
                                        <a id="currentDocumentLink"
                                            href="{{ $advisorySupport->getFirstMedia('document_support')->getUrl() }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $advisorySupport->getFirstMedia('document_support')->file_name }}
                                        </a>
                                        <label for="document"
                                            class="text-sm text-red-600 cursor-pointer hover:underline">
                                            Đổi tệp
                                        </label>
                                        <input id="document" type="file" name="document" style="display: none;"
                                            onchange="updateDocumentName(event)" />
                                    </div>
                                @else
                                    <input id="document" type="file" name="document"
                                        class="w-full max-w-xs file-input file-input-bordered file-input-accent" />
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


                            <div class="items-center space-x-6 form-group">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Hình ảnh</span>
                                </div>
                                <label class="block">
                                    <span class="sr-only">Chọn ảnh</span>
                                    <input type="file" name="image" onchange="loadFile(event)"
                                        class="block w-full text-sm file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                                <div class="mt-5 shrink-0">
                                    @php
                                        $imageUrl = $advisorySupport->getFirstMediaUrl('image_support');
                                        $defaultImageUrl = asset('adminpage/image/image_default.png');
                                    @endphp
                                    <img id="preview_img" class="object-cover rounded-md h-50 w-54"
                                        src="{{ $imageUrl ? $imageUrl : $defaultImageUrl }}" alt="Current photo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 justify-center p-3 pt-5">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
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
