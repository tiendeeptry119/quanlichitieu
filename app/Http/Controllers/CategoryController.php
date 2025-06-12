<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Danh sách danh mục của user hiện tại
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())
                              ->orderBy('type')
                              ->get();

        return view('categories.index', compact('categories'));
    }

    // Hiển thị form thêm
    public function create()
    {
        return view('categories.create');
    }

    // Lưu danh mục mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense'
        ]);

        $validated['user_id'] = Auth::id(); // Gắn user hiện tại

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Đã thêm danh mục.');
    }

    // Form sửa danh mục
    public function edit(Category $category)
    {
        // Chặn nếu không phải của user
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        return view('categories.edit', compact('category'));
    }

    // Cập nhật danh mục
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense'
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Đã cập nhật danh mục.');
    }

    // Xóa danh mục
    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Đã xóa danh mục.');
    }
}
