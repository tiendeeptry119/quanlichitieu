<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function editBalance()
    {
        $user = Auth::user();
        return view('products.balance', compact('user'));
    }

    public function updateBalance(Request $request)
    {
        // Làm sạch dữ liệu: bỏ dấu phẩy
        $cleaned = str_replace(',', '', $request->initial_balance);

        // Merge lại request để validate đúng
        $request->merge(['initial_balance' => $cleaned]);

        // Validate
        $request->validate([
            'initial_balance' => 'required|numeric'
        ]);

        // Cập nhật
        $user = Auth::user();
        $user->initial_balance = intval($cleaned);
        $user->save();

        return redirect()->route('products.index')->with('success', 'Cập nhật số dư ban đầu thành công.');
    }
}
