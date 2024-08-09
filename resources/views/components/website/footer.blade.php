<footer class="relative mx-auto mt-1 max-w-7xl ">
    <div class="relative mt-10 h-auto overflow-hidden bg-blue-800">
        <div
            class="relative z-10 mx-auto h-full w-full max-w-7xl grid-cols-2 gap-10 overflow-hidden px-3 py-6 flex justify-center items-center">
            <div class="flex flex-col md:flex-row gap-14">
                <div class="flex flex-col items-start sm:items-center justify-center gap-2 text-white">
                    <div class="flex items-start gap-1 sm:gap-4">
                        <div class="">
                            loho
                        </div>
                        <div class="font-normal text-center">
                            <small class="text-xs sm:text-sm uppercase text-blue-100">SHTT BENTRE</small>
                            <div class="text-sm sm:text-xl relative -bottom-1 uppercase font-black whitespace-nowrap">
                                SHTT BENTRE</div>
                            <small>SHTT BENTRE</small>
                        </div>
                    </div>
                </div>
                <div class="text-white flex items-center justify-center gap-8">
                    <ul class="mt-2 space-y-1 text-left text-xs sm:text-sm border-l-4 pl-3">
                        <li class="group flex items-center gap-2 text-blue-100 hover:text-white">
                            @lang('web.address'): <a target="_blank"
                                href="">Địa chỉ</a>
                        </li>
                        <li class="group flex items-center gap-2 text-blue-100 hover:text-white">
                            @lang('web.phone_number'): <a class="font-black" href="tel:098765432">098765432</a>
                        </li>
                        <li class="group flex items-center gap-2 text-blue-100 hover:text-white">
                            @lang('web.email'): <a href="mail:a@gmail.com">a@gmail.com</a>
                        </li>
                    </ul>
                    <div class="">
                    </div>
                </div>
            </div>
        </div>
        <div class="relative z-10 w-full bg-blue-900">
            <ul class="mx-auto flex h-10 max-w-7xl items-center justify-center text-blue-200 space-x-8">
                <li class="hover:text-white flex gap-2 items-center justify-center">
                    <x-bi-messenger class="size-4" />
                    <small class="hidden sm:block">Facebook messenger</small>
                </li>
                <li class="hover:text-white flex gap-2 items-center justify-center">
                    <x-heroicon-o-phone class="size-4" />
                    <small class="hidden sm:block">090 043 11 03</small>
                </li>
            </ul>
        </div>
    </div>
</footer>
