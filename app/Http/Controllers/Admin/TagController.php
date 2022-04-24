<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|unique:tags"
        ]);
        if ($validated) {
            $tag = new Tag();
            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name);
            if ($tag->save()) return redirect()->route('tag.index')->with('success', 'Tag created successfully!');
        }
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);
        if($validated) {
            $tag = Tag::find($id);
            $tag->name = $request->name;
            $tag->slug = Str::slug($request->name);
            if($tag->update())
                return redirect()->route('tag.index')->with('success', 'Tap is updated successfully');
            else
                return redirect()->back()->with('error', 'Tag is updated fail!');
        }
    }

    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect()->back()->with('success', 'Tag is deleted!');
    }
}
