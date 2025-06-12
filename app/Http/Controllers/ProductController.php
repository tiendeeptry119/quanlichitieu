<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Danh sách giao dịch
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc');

        // Lọc theo tháng
        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('date', $year)->whereMonth('date', $month);
        }

        // Lọc theo loại
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $products = $query->get();

        // Tính toán
        $totalIncome = $products->where('type', 'income')->sum('amount');
        $totalExpense = $products->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('products.index', compact('products', 'totalIncome', 'totalExpense', 'balance'));
    }

    // Form thêm giao dịch
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get(); // Nếu danh mục dùng riêng
        return view('products.create', compact('categories'));
    }

    // Lưu giao dịch mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
        ]);

        $validated['user_id'] = Auth::id();

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Đã thêm giao dịch.');
    }

    // Form sửa giao dịch
    public function edit(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::where('user_id', Auth::id())->get();

        return view('products.edit', compact('product', 'categories'));
    }

    // Cập nhật giao dịch
    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Đã cập nhật giao dịch.');
    }

    // Xóa giao dịch
    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Đã xóa giao dịch.');
    }

    // Biểu đồ tổng hợp
    public function chart()
    {
        $data = Product::where('user_id', Auth::id())
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type')
            ->toArray();

        $income = $data['income'] ?? 0;
        $expense = $data['expense'] ?? 0;

        return view('products.chart', compact('income', 'expense'));
    }
}
