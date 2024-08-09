<x-admin-layout>
    <div class="flex-grow w-full p-5 text-center">
        <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="{{ route('admin.geographical_indications.index') }}">Danh sách sáng chế</a></li>
                <li><a class="text-teal-600">Chỉnh sửa</a></li>
            </ul>
        </div>
        <x-admin.alerts.success />
        <x-admin.alerts.error />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">

            <form action="{{ route('admin.geographical_indications.update', $geographicalIndication->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4 px-3">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        {{-- cột 1 --}}
                        <div class="col-span-2 ...">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên sản phẩm
                                          <span class="text-red-500">(*)</span>
                                    </span>
                                </div>
                                <input type="text" name="name" placeholder="Nhập vào"
                                    value="{{ old('name', $geographicalIndication->name) }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đơn vị quản lý  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="management_unit" placeholder="Nhập vào"
                                    value="{{ old('management_unit', $geographicalIndication->management_unit) }}"
                                    class="input input-bordered w-full {{ $errors->has('management_unit') ? 'input-error' : '' }}" />
                                @error('management_unit')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Đơn vị uỷ quyền  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="authorized_unit" placeholder="Nhập vào"
                                    value="{{ old('authorized_unit', $geographicalIndication->authorized_unit) }}"
                                    class="input input-bordered w-full {{ $errors->has('authorized_unit') ? 'input-error' : '' }}" />
                                @error('authorized_unit')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="label-text">@lang('admin.content')</span>
                                </div>
                                <textarea name="content" id="content" class="block w-full mt-1 rounded-md shadow-sm form-input" rows="5">{{ old('content', $geographicalIndication->content) }}</textarea>
                            </label>
                        </div>
                        {{-- Cột 2 --}}
                        <div>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Huyện</span>
                                </div>
                                <select name="district_id" id="district_id"
                                    class="input input-bordered w-full @error('district_id') border-red-500 @enderror">
                                    <option value="">Chọn huyện</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', $geographicalIndication->district_id) == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
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
                                            {{ old('commune_id', $geographicalIndication->commune_id) == $commune->id ? 'selected' : '' }}>
                                            {{ $commune->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('commune_id')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số đơn  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="application_number" placeholder="Nhập vào"
                                    value="{{ old('application_number', $geographicalIndication->application_number) }}"
                                    class="input input-bordered w-full {{ $errors->has('application_number') ? 'input-error' : '' }}" />
                                @error('application_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Số văn bằng  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="text" name="certificate_number" placeholder="Nhập vào"
                                    value="{{ old('certificate_number', $geographicalIndication->certificate_number) }}"
                                    class="input input-bordered w-full @error('certificate_number') border-red-500 @enderror" />
                                @error('certificate_number')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Ngày cấp  <span class="text-red-500">(*)</span></span>
                                </div>
                                <input type="date" name="issue_date" placeholder="Nhập vào"
                                    value="{{ old('issue_date', $geographicalIndication->issue_date ? \Carbon\Carbon::parse($geographicalIndication->issue_date)->format('Y-m-d') : '') }}"
                                    class="input input-bordered w-full @error('issue_date') border-red-500 @enderror" />
                                @error('issue_date')
                                    <small class="text-red-500 text-left">{{ $message }}</small>
                                @enderror
                            </label>
                            <label class="w-full form-control">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Document</span>
                                </div>
                                @if ($geographicalIndication->hasMedia('document_geographical'))
                                    <div>
                                        <span class="text-sm font-medium text-gray-700">Tệp hiện tại:</span>
                                        <a id="currentDocumentLink"
                                            href="{{ $geographicalIndication->getFirstMedia('document_geographical')->getUrl() }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $geographicalIndication->getFirstMedia('document_geographical')->file_name }}
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
                                        <small class="text-red-500 text-left">{{ $message }}</small>
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
                                    <input type="file" name="image" onchange="loadFile(event)" accept="image/*"
                                        class="block w-full text-sm file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                </label>
                                <div class="shrink-0">
                                    @php
                                        $imageUrl = $geographicalIndication->getFirstMediaUrl('image_geographical');
                                        $defaultImageUrl = asset('adminpage/image/image_default.png');
                                    @endphp
                                    <img id="preview_img" class="object-cover h-24 rounded-md w-28"
                                        src="{{ $imageUrl ? $imageUrl : $defaultImageUrl }}" alt="Current photo" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <label class="form-control w-[95%]">
                        <div class="label">
                            <span class="text-sm font-medium text-gray-700">Ghi chú</span>
                        </div>
                        <textarea name="status" id="status"
                            class="textarea textarea-bordered @error('status') border-red-500 @enderror" rows="2">{{ old('status', $geographicalIndication->status) }}</textarea>
                        @error('status')
                            <small class="text-red-500 text-left">{{ $message }}</small>
                        @enderror
                    </label>
                </div>
                <div class="flex gap-4 justify-center p-3">
                    <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Lưu</button>
                    <a href="{{ route('admin.geographical_indications.index') }}"
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

        {{-- Get communes based on district --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src='{{ asset('adminpage/get_communes.js') }}'></script>
        <script>
            var getCommunesUrl = "{{ route('admin.patents.getCommunes', '') }}";
        </script>
    @endpushonce

</x-admin-layout>
