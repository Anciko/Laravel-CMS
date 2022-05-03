<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPostController extends Controller
{
    public function detail($slug) {
        $post = Post::where('slug' ,$slug)->first()->load('tags','category');
        $relatedPosts = Post::where('category_id' ,$post->category->id)->take(3)->get();
        // dd($relatedPosts->toArray());
        return view('postdetail', compact('post', 'relatedPosts'));
    }

    public function postByTag($slug) {
        $tags = Tag::where('slug', $slug)->first();
        $posts = $tags->posts()->latest()->paginate(6);
        // dd($posts->toArray());
        return view('index', compact('posts'));
    }

    public function postByCategory($slug) {
        $categories = Category::where('slug', $slug)->first();
        $posts = $categories->posts()->latest()->paginate(6);
        return view('index', compact('posts'));
    }
}
