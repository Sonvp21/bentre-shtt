@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative inline-flex cursor-default items-center rounded-full px-4 py-2 text-sm font-medium leading-5 ">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative inline-flex items-center rounded-full px-4 py-2 text-sm font-medium leading-5 ring-blue-300 transition duration-150 ease-in-out hover:text-blue-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-blue-100 active dark:border-blue-600 dark:bg-blue-800 dark:text-blue-300 dark:focus:border-blue-700 dark:active:bg-blue-700 dark:active:text-blue-300">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative ml-3 inline-flex items-center rounded-full px-4 py-2 text-sm font-medium leading-5 ring-blue-300 transition duration-150 ease-in-out hover:text-blue-500 focus:border-blue-300 focus:outline-none focus:ring active:bg-blue-100 active dark:border-blue-600 dark:bg-blue-800 dark:text-blue-300 dark:focus:border-blue-700 dark:active:bg-blue-700 dark:active:text-blue-300">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative ml-3 inline-flex cursor-default items-center rounded-full px-4 py-2 text-sm font-medium leading-5 ">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm leading-5">
                    @lang('web.showing')
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        @lang('web.to')
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    @lang('web.of')
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    @lang('web.results')
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-full bg-transparent rtl:flex-row-reverse">
                    {{-- Pagination Navigation --}}
                    @if ($paginator->hasPages())
                        <nav class="flex items-center justify-between">
                            <ul class="pagination flex space-x-2 items-center">
                                {{-- Previous Page Link --}}
                                @if ($paginator->onFirstPage())
                                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                        <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 cursor-not-allowed">
                                            «
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                           aria-label="@lang('pagination.previous')"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-500 transition duration-150 ease-in-out hover:bg-blue-100 focus:ring-2 focus:ring-blue-300 border-blue-300 rounded-full" style="line-height: 0.875rem">
                                           «
                                        </a>
                                    </li>
                                @endif
                
                                {{-- Pagination Elements --}}
                                @foreach ($elements as $element)
                                    {{-- "Three Dots" Separator --}}
                                    @if (is_string($element))
                                        <li class="disabled" aria-disabled="true">
                                            <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 cursor-not-allowed ">{{ $element }}</span>
                                        </li>
                                    @endif
                
                                    {{-- Array Of Links --}}
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $paginator->currentPage())
                                                <li class="active content-center" aria-current="page">
                                                    <span style="line-height: 0.875rem !important;" class="inline-flex place-content-center text-sm items-center px-3 py-2 font-medium text-blue-700 bg-blue-100  border-blue-300 rounded-full">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $url }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-500  border-blue-300 rounded-full transition duration-150 ease-in-out hover:bg-blue-100 focus:ring-2 focus:ring-blue-300" style="line-height: 0.875rem;">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                
                                {{-- Next Page Link --}}
                                @if ($paginator->hasMorePages())
                                    <li>
                                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                                           aria-label="@lang('pagination.next')"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-500 transition duration-150 ease-in-out hover:bg-blue-100 focus:ring-2 focus:ring-blue-300 border-blue-300 rounded-full" style="line-height: 0.875rem"> 
                                           »
                                        </a>
                                    </li>
                                @else
                                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                        <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 cursor-not-allowed">
                                            »
                                        </span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </span>
                
            </div>
        </div>
    </nav>
@endif
