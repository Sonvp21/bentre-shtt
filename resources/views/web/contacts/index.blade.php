<x-website-layout>
    <section>
        <div class="mx-auto max-w-7xl px-3 sm:px-6 md:items-center lg:px-8">
            <div class="grid grid-cols-8 gap-4">
                <div class="col-span-8 md:col-span-6 lg:col-span-6">
                    <div class="bg-white p-8">
                        <div class="container mx-auto">
                            <div class="mb-6 text-center">
                                <h2 class="text-2xl font-bold">@lang('web.title_web_contact')</h2>
                                <p class="text-gray-600">@lang('web.cmt_web_contact')</p>
                            </div>
                            <form action="{{ route('contacts.store') }}" method="POST" class="needs-validation space-y-4" novalidate>
                                @csrf
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="@lang('web.contacts.name')" class="input input-bordered input-success w-full">
                                        @error('name')
                                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="@lang('web.contacts.email')" class="input input-bordered input-success w-full">
                                        @error('email')
                                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div>
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="@lang('web.contacts.phone')" class="input input-bordered input-success w-full">
                                        @error('phone')
                                            <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <textarea name="content" placeholder="@lang('web.contacts.content')" class="textarea textarea-bordered textarea-success w-full" rows="8">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="mt-2 text-sm text-red-500">{{ $message }}</div>
                                @enderror

                                <div class="flex items-center justify-between">
                                    <p></p>
                                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave="transition ease-out duration-1000" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                        @if (session('success'))
                                            <p class="text-green-500">{{ session('success') }}</p>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-success">
                                        <x-far-paper-plane class="size-6" />
                                        @lang('web.send')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mb-7 bg-gray-100 p-9">
                        <div class="flex flex-col justify-between md:flex-row">
                            <div class="mb-4 border-white px-2 md:mb-0 lg:border-r">
                                <h3 class="flex items-center font-semibold">
                                    <x-heroicon-o-map-pin class="size-6" />
                                    <span class="ml-2">@lang('web.address_web')</span>
                                </h3>
                                <p class="pl-8">
                                    <a target="__blank" class="hover:text-green-900" href="https://www.google.com/maps/place/Trung+t%C3%A2m+Nghi%C3%AAn+c%E1%BB%A9u+%C4%90%E1%BB%8Ba+tin+h%E1%BB%8Dc+-+GIRC/@21.5938519,105.810809,17z/data=!3m1!4b1!4m6!3m5!1s0x313527142d4a273b:0x93ac520307150ed8!8m2!3d21.5938519!4d105.810809!16s%2Fg%2F11f15j5hkn?entry=ttu">
                                        @lang('web.title_girc')
                                    </a>
                                </p>
                                <p class="pl-8">@lang('web.time_work')</p>
                            </div>
                            <div class="mb-4 border-white px-2 md:mb-0 lg:border-r">
                                <h3 class="flex items-center font-semibold">
                                    <x-heroicon-c-globe-alt class="size-6" />
                                    <span class="ml-2">@lang('web.contact_web')</span>
                                </h3>
                                <p class="pl-8">
                                    <a href="tel:0904031103" class="hover:text-green-900">@lang('web.phone_number'):
                                        0904.031.103</a>
                                </p>
                                <p class="pl-8">(TS. Nguyễn Văn Hiểu)</p>
                            </div>
                            <div class="mb-4 px-2 md:mb-0">
                                <h3 class="flex items-center font-semibold">
                                    <x-far-paper-plane class="size-6" />
                                    <span class="ml-2">@lang('web.email_web')</span>
                                </h3>
                                <p class="pl-8">
                                    <a href="mailto:girc.tuaf@gmail.com" class="hover:text-green-900">girc.tuaf@gmail.com</a>
                                </p>
                                <p class="pl-8">@lang('web.email_web_sp')</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-website.contact-map />
                    </div>
                </div>
                <div class="col-span-8 hidden space-y-3 md:col-span-2 lg:block">
                    <x-website.announcement />
                    <x-website.science-information />
                    <x-website.aside.extra-curricular-activity />
                    <x-website.aside.study-space />
                </div>
            </div>
        </div>
    </section>
</x-website-layout>
