<x-admin-layout>
    <div class="p-6">
        <div class="text-gray-800 text-sm font-semibold leading-tight">
            <span class="text-gray-800 text-sm flex items-center gap-2 font-semibold leading-tight">
                {{ app()->getLocale() === 'en' ? $category->title_en : $category->title }}
                <x-heroicon-m-arrow-small-right class="size-4" />
                @lang('admin.edit')
            </span>
        </div>
        <x-admin.alerts.error />
        <div class="mt-6">
            <div class="overflow-x-auto bg-white rounded-lg mt-5">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <div class="space-y-4 p-3">
                        <form
                            action="{{ route('admin.categories.posts.update', ['category' => $category->id, 'post' => $post->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                            <div class="space-y-4 p-3">
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.post.published_at')</span>
                                    </div>
                                    <x-admin.forms.calendar name="published_at" value="{{ $post->published_at }}" />
                                </label>

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.post.title')</span>
                                    </div>
                                    <input type="text" name="title" placeholder="Type here"
                                        value="{{ old('title', $post->title) }}" @class([
                                            'input',
                                            'input-bordered',
                                            'w-full',
                                            'input-error' => $errors->has('title'),
                                        ]) />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.post.title_en')</span>
                                    </div>
                                    <input type="text" name="title_en" placeholder="Type here"
                                        value="{{ old('title_en', $post->title_en) }}" @class([
                                            'input',
                                            'input-bordered',
                                            'w-full',
                                            'input-error' => $errors->has('title_en'),
                                        ]) />
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.content')</span>
                                    </div>
                                    <textarea name="content" id="content" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content', $post->content) }}</textarea>
                                </label>
                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">@lang('admin.content_en')</span>
                                    </div>
                                    <textarea name="content_en" id="content_en" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5">{{ old('content_en', $post->content_en) }}</textarea>
                                </label>
                                <x-admin.forms.tags :tags="$tags" :value="old('tags', $tagNames)" />

                                <div class="flex items-center space-x-6">
                                    <div class="shrink-0">
                                        <img id="preview_img" class="h-16 w-16 rounded-full object-cover"
                                            src="{{ $post->getFirstMedia('featured_image')->getUrl('thumb') }}"
                                            alt="{{ $post->getFirstMedia('featured_image')->name }}" />
                                    </div>
                                    <label class="block">
                                        <span class="sr-only">Choose photo</span>
                                        <div class="input input-bordered flex items-center gap-2 border px-3 py-2">
                                            File:
                                            <span
                                                id="selected_file_name">{{ $post->getFirstMedia('featured_image')->name }}</span>
                                        </div>

                                        <input class="hidden" type="file" name="image" onchange="loadFile(event)"
                                            class="file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 block w-full text-sm text-slate-500 file:mr-4 file:rounded-full file:border-0 file:px-4 file:py-2 file:text-sm file:font-semibold" />
                                    </label>
                                </div>
                                <div class="flex justify-end gap-4">
                                    <a href="{{ route('admin.categories.posts.index', ['slug' => $category->slug]) }}"
                                        class="btn-light btn">@lang('admin.btn.cancel')</a>
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
        <x-admin.forms.tinymce-config-en-vi column="content" columnen="content_en" model="Post" />
        <script>
            var loadFile = function(event) {
                var input = event.target
                var file = input.files[0]
                var type = file.type

                var output = document.getElementById('preview_img')

                output.src = URL.createObjectURL(event.target.files[0])
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        </script>
    @endpushonce
</x-admin-layout>
