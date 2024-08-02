<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight">
            <span class="text-3xl uppercase font-semibold">
                @lang('admin.faqs')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.add')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="bg-white px-8 pb-8 pt-0 shadow sm:rounded-lg">
                        <form action="{{ route('admin.faqs.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="space-y-4 p-3">
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.name')</span>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Put name"
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('name'),
                                            'w-full',
                                        ]) />
                                    </label>
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.email')</span>
                                        </div>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="email..."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('email'),
                                            'w-full',
                                        ]) />
                                    </label>
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.phone')</span>
                                        </div>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="0987...."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('phone'),
                                            'w-full',
                                        ]) />
                                    </label>
                                <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.address')</span>
                                        </div>
                                        <input type="text" name="address" value="{{ old('address') }}" placeholder="address.."
                                        @class([
                                            'input',
                                            'input-bordered',
                                            'input-error' => $errors->has('address'),
                                            'w-full',
                                        ]) />
                                    </label>
                                    <label class="form-control w-full">
                                        <div class="label">
                                            <span class="label-text">@lang('admin.faqs.question')</span>
                                        </div>
                                        <textarea name="question" id="question" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('question', $faq->question ?? '') }}</textarea>

                                    </label>

                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn-light btn">@lang('admin.btn.cancel')
                                    </a>
                                    <button type="submit" class="btn btn-success ml-2">
                                        @lang('admin.btn.submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @pushonce('bottom_scripts')
        <x-admin.forms.tinymce-config column="question" model="Faq"/>
    @endpushonce
</x-admin-layout>
