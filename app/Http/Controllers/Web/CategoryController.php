<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function showPost(Category $category, Post $post)
    {
        $post = Post::where('slug', $post->slug)->firstOrFail();
        $siblingCategories = Category::where('parent_id', $category->parent_id)
            ->where('id', '!=', $category->id)
            ->whereNotNull('parent_id')
            ->get();

        return view('web.categories.show_post_first_category', compact('category', 'post', 'siblingCategories'));
    }

    public function showAllPosts(Category $category)
    {
        $posts = Post::where('category_id', $category->id)
            ->published()
            ->latest('published_at')
            ->latest('updated_at')
            ->paginate(7);

        return view('web.categories.all_post_of_category', compact('category', 'posts'));
    }
}
