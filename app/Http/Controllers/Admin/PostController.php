<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
       $posts = Post::with('category')->get();
       return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $imageName);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->featured = $imageName;
        $post->category_id = $request->category;

        $post->save();
        return redirect()->route('post.index')->with('success', 'Post created successfully!');
    }

    public function show($id)
    {
        $post = Post::find($id)->load('category');
        return view('admin.post.detail',compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id)->load('category');
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;

        if($request->hasFile('featured')) {
            $file = $request->file('featured');
            $imageName = uniqid() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $imageName);
            $post->featured = $imageName;
        }
        $post->update();
        return redirect()->route('post.index')->with('success', 'Post is updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->back()->with('success', $post->title .' is deleted successfully!');
    }
}
