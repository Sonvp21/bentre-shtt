<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('published_at', 'desc')->paginate(10);

        return view('admin.categories.posts.index', [
            'category' => $category,
            'posts' => $posts,
        ]);
    }

    public function create($categoryId): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        $category = Category::findOrFail($categoryId);

        return view('admin.categories.posts.create', compact('tags', 'categories', 'category'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required',
        ]);
        $post = Post::create($request->all());

        if ($request->tags) {
            $tagIds = [];
            $tags = json_decode($request->tags);
            foreach ($tags as $tagObj) {
                $tag = Tag::firstOrCreate(['name' => trim($tagObj->value)]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $post->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('featured_image');
        }
        $category = Category::findOrFail($request->category_id);

        return redirect()->route('admin.categories.posts.index', ['slug' => $category->slug])->with('success', trans('admin.alerts.success.create'));
    }

    /**
     * @return RedirectResponse
     */
    public function edit($categoryId, $postId): View
    {
        $category = Category::findOrFail($categoryId);
        $post = Post::with('tags')->findOrFail($postId);
        $tags = Tag::all();
        $tagNames = $post->tags->pluck('name')->toJson();

        return view('admin.categories.posts.edit', compact('category', 'post', 'tags', 'tagNames'));
    }

    public function update(PostRequest $request, $categoryId, $postId): RedirectResponse
    {
        $post = Post::findOrFail($postId);

        DB::beginTransaction();
        try {
            $post->update($request->all());

            if ($request->tags) {
                $tagIds = collect(json_decode($request->tags, true))->pluck('value')->map(function ($name) {
                    return Tag::firstOrCreate(['name' => trim($name)])->id;
                });
                $post->tags()->sync($tagIds);
                $unusedTags = Tag::whereDoesntHave('posts')->get();
                foreach ($unusedTags as $unusedTag) {
                    $unusedTag->delete();
                }
            }
            if ($request->hasFile('image')) {
                $imageFile = $request->file('image');
                $post->clearMediaCollection('featured_image');
                $post->addMedia($imageFile->getRealPath())
                    ->usingFileName($imageFile->getClientOriginalName())
                    ->usingName($imageFile->getClientOriginalName())
                    ->toMediaCollection('featured_image');
            }

            DB::commit();
            $category = Category::findOrFail($categoryId);

            return redirect()->route('admin.categories.posts.index', ['slug' => $category->slug])->with('success', trans('admin.alerts.success.edit'));
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error updating post: '.$e->getMessage());
        }
    }

    public function destroy($category_id, $post_id)
    {
        $category = Category::findOrFail($category_id);
        $post = $category->posts()->findOrFail($post_id);
        $post->clearMediaCollection('featured_image');
        $post->tags()->detach();
        $post->delete();
        $unusedTags = Tag::doesntHave('posts')->get();
        foreach ($unusedTags as $unusedTag) {
            $unusedTag->delete();
        }

        return back()->with('success', trans('admin.alerts.success.deleted'));
    }
}
