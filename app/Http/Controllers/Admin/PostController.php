<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->paginate(4);
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request)
    {
        $file = $request->file('image');
        $imageName = uniqid() . '-' .  $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $imageName);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = Str::slug($request->title);
        $post->featured = $imageName;
        $post->category_id = $request->category;

        if ($post->save()) {
            $post->tags()->attach($request->tags);
            return redirect()->route('post.index')->with('success', 'Post created successfully!');
        } else {
            return redirect()->back()->with('error', 'Post created Fail!');
        }
    }

    public function show($id)
    {
        $post = Post::find($id)->load('category');
        return view('admin.post.detail', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id)->load('category');
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->slug = Str::slug($post->title);

        if ($request->hasFile('featured')) {
            $file = $request->file('featured');
            $imageName = uniqid() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $imageName);
            $post->featured = $imageName;
        } 

        if ($post->update()) {
            $post->tags()->sync($request->tags);
            return redirect()->route('post.index')->with('success', 'Post is updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Post updated error!');
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('success', $post->title . ' is deleted successfully!');
    }
}
