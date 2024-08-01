<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-sm font-semibold leading-tight">
            <span class="text-gray-800 text-sm flex items-center gap-2 font-semibold leading-tight">
                @lang('admin.faqs')
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.faqs.show')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <a
                href="{{ route('admin.faqs.index') }}"
                class="bg-gray-300 text-gray-700 hover:bg-gray-400 active:bg-gray-500 focus:border-gray-500 focus:ring-gray-300 inline-flex items-center rounded-md px-4 py-2 text-xs font-semibold uppercase tracking-widest transition focus:outline-none focus:ring disabled:opacity-25"
            >
                <x-heroicon-o-arrow-left class="mr-2 size-4" />
                @lang('admin.back')
            </a>
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="border-gray-200 border-b bg-white p-6">
                    <div class="stats shadow">
                        <div class="stat">
                            <div class="stat-figure text-secondary">
                                <div class="avatar online">
                                    <div class="w-16 rounded-full">
                                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>
                                </div>
                            </div>
                            <div class="stat-figure text-primary">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="inline-block h-8 w-8 stroke-current"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="stat-value text-primary">{{ $faq->name }}</div>
                        </div>

                        <div class="stat">
                            <div class="stat-title">{{ $faq->email }}</div>
                            <div class="stat-desc">{{ $faq->phone }}</div>
                            <div class="stat-desc">{{ $faq->address }}</div>
                            <p class="text-gray-500 mt-1 max-w-2xl text-sm">
                                @lang('admin.faqs.read_at')
                                :{{ $faq->read_at ? $faq->read_at : 'Not read yet' }}
                            </p>
                        </div>
                    </div>
                    <div class="grid w-fit grid-cols-1 gap-4 md:grid-cols-1">
                        <div class="chat chat-start flex">
                            <h3 class="text-gray-900 text-lg font-medium leading-6">
                                @lang('admin.faqs.question')
                                :
                            </h3>
                            <div class="chat-bubble">{!! $faq->question !!}</div>
                            <p class="text-gray-500 ml-auto mt-1 max-w-2xl text-sm">
                                @lang('admin.faqs.created_at')
                                :{{ $faq->createdAtVi }}
                            </p>
                        </div>

                        <form
                            action="{{ route('admin.faqs.update', $faq) }}"
                            method="POST"
                        >
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <div class="flex">
                                <h3 class="text-gray-900 text-lg font-medium leading-6">
                                    @lang('admin.faqs.answer')
                                    :
                                </h3>
                                <p class="text-gray-500 ml-auto mt-1 max-w-2xl text-sm">
                                    @lang('admin.faqs.answer_at')
                                    :{{ $faq->answer_at ? $faq->answer_at : 'Not answer yet' }}
                                </p>
                            </div>

                            <input
                                type="hidden"
                                name="id"
                                value="{{ $faq->id }}"
                            />
                            <div class="mt-1 flex items-center text-sm">
                                <svg
                                    style="width: 20px; position: absolute"
                                    class="text-teal-500 mr-2 h-4 w-4 flex-none"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <textarea
                                    style="margin-left: 30px"
                                    name="answer"
                                    class="border-gray-300 h-auto w-full rounded-md shadow-sm"
                                    required
                                >
{!! $faq->answer ?: old('answer') !!}</textarea
                                >
                            </div>
                            <div
                                class="mt-3"
                                style="margin-left: 24%"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-success ml-2"
                                >
                                    @lang('admin.btn.submit')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
