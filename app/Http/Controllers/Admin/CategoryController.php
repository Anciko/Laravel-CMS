<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:categories'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $category = new Category();
        $category->name = $request->category;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['category' => 'required']);
        if ($validated) {
            $category = Category::find($id);
            $category->name = $request->category;
            $category->update();

            return redirect()->route('category.index')->with('success', 'Category is updated successfully!');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category '. $category->name . ' is deleted!');
    }
}
