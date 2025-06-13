<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Thêm dòng này -->
    <title>Sửa Giao Dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5 d-flex justify-content-center">
    <div class="col-12 col-md-6"> <!-- Responsive container cho form -->

        <h2 class="mb-4 text-center">✏️ Sửa Giao Dịch</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Tiêu đề -->
            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
            </div>

            <!-- Số tiền -->
            <div class="mb-3">
                <label class="form-label">Số tiền (₫)</label>
                <input type="number" name="amount" class="form-control" min="0" value="{{ old('amount', $product->amount) }}">
            </div>

            <!-- Loại giao dịch -->
            <div class="mb-3">
                <label class="form-label">Loại giao dịch</label>
                <select name="type" class="form-select" required>
                    <option value="income" {{ $product->type == 'income' ? 'selected' : '' }}>Thu</option>
                    <option value="expense" {{ $product->type == 'expense' ? 'selected' : '' }}>Chi</option>
                </select>
            </div>

            <!-- Danh mục -->
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Không chọn --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ngày giao dịch -->
            <div class="mb-3">
                <label class="form-label">Ngày giao dịch</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $product->date) }}" required>
            </div>

            <!-- Nút -->
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

</body>
</html>
