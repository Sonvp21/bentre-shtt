<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight">
            <span class="text-3xl uppercase font-semibold">
                @lang('admin.categories.list')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4 needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.title')</span>
                            </div>
                            <input type="text" name="title" placeholder="Title..."
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title'),
                                    'w-full',
                                ])
                                value="{{ old('title') }}"
                            />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.title_en')</span>
                            </div>
                            <input type="text" name="title_en" placeholder="Title english(if have)"
                                @class([
                                    'input',
                                    'input-bordered',
                                    'input-error' => $errors->has('title_en'),
                                    'w-full',
                                ])
                                value="{{ old('title_en') }}"
                            />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.parent')</span>
                            </div>
                            <select name="parent_id" @class([
                                'input',
                                'input-bordered',
                                'w-full',
                            ])>
                                <option value="">@lang('admin.categories.select_parent')</option>
                                @foreach ($categories as $category)
                                    <x-admin.forms.select.category :category="$category" />
                                @endforeach
                            </select>
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">@lang('admin.categories.in_menu')</span>
                            </div>
                            <select name="in_menu" @class([
                                'input',
                                'input-bordered',
                                'w-full',
                            ])>
                                <option @selected(old('in_menu') == 0) value="0">@lang('admin.false')</option>
                                <option @selected(old('in_menu') == 1) value="1">@lang('admin.true')</option>
                            </select>
                        </label>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn-light btn">
                                @lang('admin.btn.cancel')
                            </a>
                            <button type="submit" class="btn btn-success ml-2">
                                @lang('admin.btn.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
