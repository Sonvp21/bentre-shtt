<div class="sticky top-0 z-30">
    <div class="navbar bg-base-100 mx-auto mt-1 max-w-7xl ">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Item 1</a></li>
                    <li>
                        <a>Parent</a>
                        <ul class="p-2 z-50">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </li>
                    <li><a>Item 3</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost text-xl">Bentre-shtt</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a>Item 1</a></li>
                <li>
                    <details>
                        <summary>Parent</summary>
                        <ul class="p-2 z-50">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </details>
                </li>
                <li><a>Item 3</a></li>
            </ul>
        </div>
    </div>
    <div class="bg-gray-100/60 backdrop-blur max-w-7xl mx-auto">
        <div class="items-left mx-auto flex h-10 max-w-7xl flex-row justify-between px-3 sm:px-6 lg:px-8">
            <div class="hidden items-center gap-4 text-blue-800 sm:flex">
                <i class="fad fa-calendar-star"></i>
                <div class="flex items-center whitespace-nowrap pr-5 text-sm capitalize">
                    {{ now()->translatedFormat('l d/m/Y') }}
                </div>
            </div>
            <div class="flex w-full items-center gap-6 whitespace-nowrap pl-4 text-sm sm:w-auto">
                <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700"
                    href="{{ route('contacts.index') }}">
                    <div class="rounded bg-yellow-500 p-1 text-white">
                        <x-heroicon-s-phone class="size-4" />
                    </div>
                    <span>@lang('web.contact')</span>
                </a>
                <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700 sm:w-auto"
                    href="{{ route('faqs.index') }}">
                    <div class="rounded bg-yellow-500 p-1 text-white">
                        <x-heroicon-m-question-mark-circle class="size-4" />
                    </div>
                    <span>@lang('web.faqs')</span>
                </a>
                <a class="flex w-full items-center gap-2 text-slate-700 hover:text-blue-700 sm:w-auto"
                    href="{{ route('login') }}">
                    <div class="rounded bg-yellow-500 p-1 text-white">
                        <x-heroicon-s-arrow-left-end-on-rectangle class="size-4 rotate-180" />
                    </div>
                    <span>@lang('web.login')</span>
                </a>
            </div>
        </div>
    </div>
</div>
