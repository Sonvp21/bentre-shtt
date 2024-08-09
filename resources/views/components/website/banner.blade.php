<div class="custom-background">
    <style>
        .custom-background {
            background-image: url('testhomepage/background-head.png');
            background-size: cover; /* Hoặc sử dụng 'contain' tùy theo nhu cầu */
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <div class="mx-auto flex max-w-7xl justify-between px-3 py-2 text-xs text-gray-700 sm:px-6 lg:px-8">
        <div class="flex gap-3">
            <a class="flex items-center justify-center gap-1 hover:text-green-700" href="#"
                target="_blank">
                <x-heroicon-c-globe-alt class="size-4" />
                <span class="hidden sm:block">Website...</span>
            </a>
            <div class="flex gap-3">
                <a class="flex items-center justify-center gap-1 hover:text-blue-700" target="_blank"
                    href="">
                    <x-bi-facebook class="size-4" />
                    <span class="hidden sm:block">Follow us</span>
                </a>
                <a class="flex items-center justify-center gap-1 hover:text-green-700"
                    href="mailto:...">
                    <x-heroicon-s-envelope class="size-4" />
                    <span class="hidden sm:block">...c@tuaf.edu.vn</span>
                </a>
            </div>
        </div>
        <div class="flex flex-row gap-3">
            <div class="flex-none">
                <div class="flex items-center gap-3">
                    <a href="{{ url('/locale/vi') }}">
                        <img class="w-5 grayscale hover:filter-none" src="{{ asset('testhomepage/vn.png') }}"
                            alt="" />
                    </a>
                    {{-- <p>Current locale: {{ App::getLocale() }}</p> --}}

                    <a href="{{ url('/locale/en') }}">
                        <img class="w-5 grayscale hover:filter-none" src="{{ asset('testhomepage/uk.png') }}"
                            alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto max-w-7xl flex-col justify-between px-3 sm:px-6 md:items-center lg:flex lg:flex-row lg:px-8">
        <div class="flex w-full items-center justify-between py-3">
            <img class="h-12 md:h-20 lg:h-24" src="{{ asset('testhomepage/background-head.png') }}" alt="" />
        </div>
    </div>
</div>
