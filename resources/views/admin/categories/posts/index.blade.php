<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-3xl uppercase font-semibold leading-tight">
            <span class="text-3xl uppercase font-semibold">
                {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
            </span>
        </div>
        <x-admin.alerts.success />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="overflow-x-auto">
                    <div class="flex px-6 py-4">
                        <form action="{{ route('admin.categories.posts.index', $category->slug) }}" method="GET"
                            class="w-full">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="input input-bordered flex items-center gap-2">
                                        <input name="search" type="text" class="grow" placeholder="Search by name"
                                            style="border: unset" value="{{ request()->search }}" />
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
                                <a class="btn-ghosdt btn"
                                    href="{{ route('admin.categories.posts.create', ['category' => $category]) }}">
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
                                <th>@lang('admin.post.title')</th>
                                <th>@lang('admin.post.category_of')</th>
                                <th>@lang('admin.post.published_at')</th>
                                {{-- ngày đăng --}}
                                <th>@lang('admin.post.updated_at')</th>
                                {{-- ngày cập nhật --}}
                                <th>@lang('admin.funtion')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{ $posts->firstItem() + $loop->index }}</th>
                                    <td>{{ app()->getLocale() === 'en' && !empty($post->title_en) ? $post->title_en : $post->title }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>{{ $post->publishedAtVi }}</td>
                                    <td>{{ $post->updatedAtVi }}</td>

                                    <td class="flex gap-3">
                                        <a
                                            href="{{ route('admin.categories.posts.edit', ['category' => $category->id, 'post' => $post->id]) }}">
                                            <x-heroicon-s-pencil-square class="size-4 text-green-600" />
                                        </a>
                                        <form id="delete-form-{{ $post->id }}"
                                            action="{{ route('admin.categories.posts.destroy', ['category' => $category->id, 'post' => $post->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete({{ $post->id }})">
                                                <x-heroicon-o-trash class="size-4 text-red-500" />
                                            </button>
                                        </form>
                                        <script>
                                            function confirmDelete(postId) {
                                                if (confirm('Are you sure you want to delete this post?')) {
                                                    document.getElementById('delete-form-' + postId).submit();
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
            {{ $posts->links('pagination.web-tailwind') }}
        </div>
    </div>
</x-admin-layout>
