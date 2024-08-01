<x-admin-layout>
    <div class="flex-grow w-full p-5">
        <div class="breadcrumbs text-sm">
            <ul>
                    <li><a href="{{ route('admin.roles.index') }}">Danh sách vai trò</a></li>
                    <li><a class="text-teal-600">Chỉnh sửa vai trò</a></li>
                </ul>
        </div>
        <x-admin.alerts.success />
        <div class="overflow-x-auto bg-white rounded-lg mt-5">
            <div class="overflow-x-auto p-5">
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="grid grid-cols-3 gap-4 !m-0">
                        <div class="col-span-2">
                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Tên vai trò</span>
                                </div>
                                <input type="text" name="name" placeholder="...." value="{{ $role->name }}"
                                    class="input input-bordered w-full {{ $errors->has('name') ? 'input-error' : '' }}" />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>

                            <label class="form-control w-[95%]">
                                <div class="label">
                                    <span class="text-sm font-medium text-gray-700">Mô tả vai trò</span>
                                </div>
                                <input type="text" name="display_name" placeholder="..."
                                    value="{{ $role->display_name }}"
                                    class="input input-bordered w-full {{ $errors->has('display_name') ? 'input-error' : '' }}" />
                                @error('display_name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </label>
                        </div>
                    </div>
                    <div class="row p-3">
                        <label>
                            <input type="checkbox" class="checkall checkbox checkbox-accent">   Tất cả
                        </label>

                        @foreach ($permissionsParent as $permissionsParentItem)
                            <div class="card border-primary mb-3 col-md-12 mt-3">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" value=""
                                            class="checkbox_wrapper checkbox checkbox-accent">
                                    </label>
                                    Module {{ $permissionsParentItem->module }}
                                </div>
                                <div class="row flex">
                                    @foreach ($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                        <div class="card-body text-sm col-md-3">
                                            <h5 class="text-sm card-title">
                                                <label>
                                                    <input type="checkbox" name="permission_id[]"
                                                        class="checkbox_childrent checkbox checkbox-accent"
                                                        value="{{ $permissionsChildrentItem->id }}"
                                                        {{ $role->permissions->contains($permissionsChildrentItem->id) ? 'checked' : '' }}>
                                                </label>
                                                {{ $permissionsChildrentItem->action }}
                                            </h5>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="flex justify-center pb-3">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline btn-error !min-h-9 h-9">Huỷ</a>
                        <button type="submit" class="btn btn-outline btn-accent !min-h-9 h-9 mx-4">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @pushonce('bottom_scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var jq = $.noConflict();
            jq(document).ready(function() {
                jq('.checkbox_wrapper').on('click', function() {
                    jq(this).parents('.card').find('.checkbox_childrent').prop('checked', jq(this).prop(
                        'checked'));
                });

                jq('.checkall').on('click', function() {
                    jq(this).parents().find('.checkbox_childrent').prop('checked', jq(this).prop('checked'));
                    jq(this).parents().find('.checkbox_wrapper').prop('checked', jq(this).prop('checked'));
                });
            });
        </script>
    @endpushonce
</x-admin-layout>
