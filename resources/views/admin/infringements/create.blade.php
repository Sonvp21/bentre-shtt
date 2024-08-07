<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            
                <ul>
                    <li><a href="{{ route('admin.infringements.index') }}">Danh sách vi phạm</a></li>
                    <li><a class="text-teal-600">Thêm mới</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

                <form action="{{ route('admin.infringements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-flow-row-dense grid-cols-3 grid-rows-1 ...">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên vi phạm</span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào" value="{{ old('name') }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
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

                            
                        </div>
                        <div class="col-span-1">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Thời gian vi phạm</span>
                                </div>
                                <input type="date" name="date" placeholder="Select Submission Date"
                                    value="{{ old('date') }}"
                                    class="input input-bordered w-full @error('date') border-red-500 @enderror" />
                                @error('date')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số tiền phạt (vnđ)</span>
                                </div>
                                <input type="penalty_amount" name="penalty_amount" placeholder="5 000 000"
                                    value="{{ old('penalty_amount') }}"
                                    class="input input-bordered w-full @error('penalty_amount') border-red-500 @enderror" />
                                @error('penalty_amount')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">trạng thái</span>
                                </div>
                                <textarea name="status" id="status" placeholder="Phát hiện ban đầu, Đang điều tra, Xác nhận vi phạm..."
                                    class="h-auto form-textarea input input-bordered w-full @error('status') border-red-500 @enderror" >{{ old('status') }}</textarea>
                                @error('status')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tài liệu đính kèm</span>
                                </div>
                                <input type="file" name="document" id="document"
                                    class="w-full max-w-xs file-input file-input-bordered file-input-accent" />
                                @error('document')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </label>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center p-3">
                        <a href="{{ route('admin.infringements.index') }}"
                            class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Thêm</button>
                    </div>
                </form>

        </div>
    </div>


    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="content" model="Post" />
    @endpushonce

</x-admin-layout>
