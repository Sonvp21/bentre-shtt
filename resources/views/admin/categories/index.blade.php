<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight">
            <span class="text-3xl uppercase font-semibold">
                @lang('admin.categories.list')
            </span>
        </div>
        <x-admin.alerts.success />
<x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.categories.index') }}" method="GET" class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input name="search" type="text" class="grow"
                                            placeholder="Search by title" style="border: unset"
                                            value="{{ request()->search }}" />
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="h-4 w-4 opacity-70">
                                                <path fill-rule="evenodd"
                                                    d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </label>
                                </div>
                                <a class="btn-ghosdt btn" href="{{ route('admin.categories.create') }}">
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
                                <th>@lang('admin.categories.order')</th>
                                <th>@lang('admin.categories.title')</th>
                                <th>@lang('admin.categories.created_at')</th>
                                <th>@lang('admin.categories.updated_at')</th>
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th>
                                        {{ $loop->index + 1 }}
                                    </th>
                                    <td>
                                        <div class="badge bg-blue-700 text-white">{{ $category->order }}</div>
                                    </td>
                                    <td>{{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}</td>
                                    <td>{{ $category->createdAtVi }}</td>
                                    <td>{{ $category->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"><x-heroicon-s-pencil-square
                                                class="size-4 text-green-600" /></a>
                                        <form id="delete-form-{{ $category->id }}"
                                            action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>
                                        <button type="button" onclick="confirmDelete({{ $category->id }})">
                                            <x-heroicon-o-trash class="size-4 text-red-500" />
                                        </button>

                                        <script>
                                            function confirmDelete(categoryId) {
                                                if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
                                                    document.getElementById('delete-form-' + categoryId).submit();
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
            {{--            {{ $categories->links('pagination.web-tailwind') }} --}}
        </div>
    </div>
</x-admin-layout>
