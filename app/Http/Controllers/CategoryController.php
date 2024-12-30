<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\support\facades\validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories_index', compact('categories'));
    }

    public function create()
    {
        
        return view('categories_create');
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:categories,name',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput(); // Kembalikan input yang telah dimasukkan
            }

            // Simpan atau perbarui kategori
            Category::updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->name]
            );

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to save category: ' . $e->getMessage()]);
        }
    }

    public function edit(Category $category)
    {
        return view('categories_edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:categories,name,' . $category->id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Update kategori
            $category->update($request->all());

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update category: ' . $e->getMessage()]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete category: ' . $e->getMessage()]);
        }
    }
}
