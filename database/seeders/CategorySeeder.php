<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $income = ['Lương', 'Thưởng', 'Lãi ngân hàng', 'Đầu tư', 'Kinh doanh', 'Cho tặng', 'Hoàn tiền', 'Khác'];
        $expense = ['Ăn uống', 'Nhà ở', 'Di chuyển', 'Giải trí', 'Mua sắm', 'Y tế & thuốc', 'Giáo dục', 'Gia đình', 'Tiết kiệm', 'Khác'];

        foreach ($income as $name) {
            Category::create(['name' => $name, 'type' => 'income']);
        }
        foreach ($expense as $name) {
            Category::create(['name' => $name, 'type' => 'expense']);
        }
    }
}

