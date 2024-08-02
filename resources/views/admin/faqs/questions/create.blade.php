<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.questions.index') }}">Danh sách câu hỏi</a></li>
                <li><a class="text-teal-600">Thêm mới</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-2 ...">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên người gửi</span>
                                </div>
                                <input type="text" name="name_sender" placeholder="Nhập vào"
                                    value="{{ old('name_sender') }}"
                                    class="input input-bordered w-full {{ $errors->has('name_sender') ? 'input-error' : '' }}" />
                                @error('name_sender')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Trạng thái</span>
                                </div>
                                <select name="status" id="status" class="form-select input input-bordered w-full @error('status') border-red-500 @enderror">
                                    <option value="" disabled selected>Chọn trạng thái</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Phê duyệt</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Chưa phê duyệt</option>
                                </select>
                                @error('status')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Email</span>
                        </div>
                        <input type="text" name="email" placeholder="Nhập vào" value="{{ old('email') }}"
                            class="input input-bordered w-full {{ $errors->has('email') ? 'input-error' : '' }}" />
                        @error('email')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Tiêu đề</span>
                        </div>
                        <input type="text" name="title" placeholder="Nhập vào" value="{{ old('title') }}"
                            class="input input-bordered w-full {{ $errors->has('title') ? 'input-error' : '' }}" />
                        @error('title')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="form-control w-full">
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
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
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
