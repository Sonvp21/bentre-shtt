<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.questions.index') }}">Danh sách câu hỏi</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.questions.update', $question) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên người gửi</span>
                                </div>
                                <input type="text" name="name_sender" placeholder="Nhập vào"
                                    value="{{ old('name_sender', $question->name_sender) }}"
                                    class="input input-bordered w-full {{ $errors->has('name_sender') ? 'input-error' : '' }}" />
                                @error('name_sender')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status"
                                    class="select select-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="1"
                                        {{ old('status', $question->status) == 1 ? 'selected' : '' }}>
                                        Phê duyệt</option>
                                    <option value="2"
                                        {{ old('status', $question->status) == 2 ? 'selected' : '' }}>
                                        Chưa phê duyệt</option>
                                </select>
                                @error('status')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Email</span>
                        </div>
                        <input type="text" name="email" placeholder="Nhập vào"
                            value="{{ old('email', $question->email) }}"
                            class="input input-bordered w-full {{ $errors->has('email') ? 'input-error' : '' }}" />
                        @error('email')
                            <small class="text-red-500 text-left">{{ $message }}</small>
                        @enderror
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Tiêu đề</span>
                        </div>
                        <input type="text" name="title" placeholder="Nhập vào"
                            value="{{ old('title', $question->title) }}"
                            class="input input-bordered w-full {{ $errors->has('title') ? 'input-error' : '' }}" />
                        @error('title')
                            <small class="text-red-500 text-left">{{ $message }}</small>
                        @enderror
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">@lang('admin.content')</span>
                        </div>
                        <textarea name="content" id="content"
                            class="form-input rounded-md shadow-sm mt-1 block w-full {{ $errors->has('content') ? 'input-error' : '' }}"
                            rows="1">{{ old('content', $question->content) }}</textarea>
                        @error('content')
                            <small class="text-red-500 text-left">{{ $message }}</small>
                        @enderror
                    </label>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.questions.index') }}"
                        class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                </div>

            </form>

        </div>
    </div>

    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="content" model="Post" />
    @endpushonce

</x-admin-layout>
