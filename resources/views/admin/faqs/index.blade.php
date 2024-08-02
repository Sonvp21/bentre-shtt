<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight">
            <span class="text-3xl uppercase font-semibold">
                @lang('admin.faqs')
            </span>
        </div>
        <x-admin.alerts.success />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form
                            action="{{ route('admin.faqs.index') }}"
                            method="GET"
                            class="w-full"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input
                                            name="search"
                                            type="text"
                                            class="grow"
                                            placeholder="Search by name"
                                            style="border: unset"
                                            value="{{ request()->search }}"
                                        />
                                        <button type="submit">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 16 16"
                                                fill="currentColor"
                                                class="h-4 w-4 opacity-70"
                                            >
                                                <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                                <a
                                    class="btn-ghosdt btn"
                                    href="{{ route('admin.faqs.create') }}"
                                >
                                    <x-heroicon-s-plus class="size-4" />
                                    <span>@lang('admin.add')</span>
                                </a>
                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.faqs.name')</th>
                                <th>@lang('admin.faqs.email')</th>
                                <th>@lang('admin.faqs.question')</th>
                                <th>@lang('admin.faqs.read_at')</th>
                                <th>@lang('admin.faqs.answer_at')</th>
                                {{-- ngày xem --}}
                                <th>@lang('admin.faqs.created_at')</th>
                                {{-- ngày gửi --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($faqs as $faq)
                                <tr>
                                    <th>{{ $faqs->firstItem() + $loop->index }}</th>
                                    <td>{{ $faq->name }}</td>
                                    <td>{{ $faq->email }}</td>
                                    <td>{!! Str::limit($faq->question, 50) !!}</td>
                                    <td>{{ $faq->read_at }}</td>
                                    <td>{{ $faq->answer_at }}</td>
                                    <td>{{ $faq->createdAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.faqs.show', $faq->id) }}"><x-heroicon-o-eye class="size-4 text-green-600" /></a>
                                        <form
                                            id="delete-form-{{ $faq->id }}"
                                            action="{{ route('admin.faqs.destroy', ['faq' => $faq->id]) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="button"
                                                onclick="confirmDelete({{ $faq->id }})"
                                            >
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(faqId) {
                                                if (confirm('Are you sure you want to delete this faq?')) {
                                                    document.getElementById('delete-form-' + faqId).submit()
                                                }
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $faqs->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-admin-layout>
