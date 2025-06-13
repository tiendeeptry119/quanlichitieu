<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Giao Dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">✏️ Sửa Giao Dịch</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số tiền (₫)</label>
            <input type="text" name="amount" class="form-control" required 
                   value="{{ number_format(old('amount', $product->amount), 0, ',', ',') }}"
                   pattern="[\d,\.]+">
        </div>

        <div class="mb-3">
            <label class="form-label">Loại giao dịch</label>
            <select name="type" class="form-select" required>
                <option value="income" {{ $product->type == 'income' ? 'selected' : '' }}>Thu</option>
                <option value="expense" {{ $product->type == 'expense' ? 'selected' : '' }}>Chi</option>
            </select>
        </div>

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

        <div class="mb-3">
            <label class="form-label">Ngày giao dịch</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $product->date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<!-- JS: Format tiền khi nhập -->
<script>
    const amountInput = document.querySelector('input[name="amount"]');

    amountInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/,/g, '').replace(/[^\d.]/g, '');
        if (!isNaN(value) && value.length > 0) {
            e.target.value = Number(value).toLocaleString('en-US');
        } else {
            e.target.value = '';
        }
    });
</script>

</body>
</html>
