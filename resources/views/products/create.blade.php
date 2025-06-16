<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Giao Dịch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- responsive meta -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">➕ Thêm Giao Dịch Mới</h2>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <!-- Tiêu đề -->
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <!-- Số tiền -->
        <div class="mb-3">
            <label class="form-label">Số tiền</label>
            <input type="text" name="amount" class="form-control" required pattern="[\d,\.]+">
        </div>

        <!-- Loại -->
        <div class="mb-3">
            <label class="form-label">Loại</label>
            <select name="type" id="type" class="form-select" required onchange="filterCategories()">
                <option value="">-- Chọn loại --</option>
                <option value="income">Thu</option>
                <option value="expense">Chi</option>
            </select>
        </div>

        <!-- Danh mục -->
        <div class="mb-3">
            <label class="form-label d-block">Danh mục</label>
            <div class="d-flex flex-column flex-sm-row gap-2">
                <select name="category_id" id="category_id" class="form-select flex-grow-1">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-type="{{ $category->type }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <a href="{{ route('categories.create') }}" class="btn btn-outline-success">➕</a>
            </div>
        </div>

        <!-- Ngày -->
        <div class="mb-4">
            <label class="form-label">Ngày</label>
            <input type="date" name="date" class="form-control" value="{{ now()->toDateString() }}" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Lưu giao dịch</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
</div>

<!-- JS: Lọc danh mục theo loại -->
<script>
    function filterCategories() {
        const selectedType = document.getElementById('type').value;
        const categorySelect = document.getElementById('category_id');
        const options = categorySelect.querySelectorAll('option');

        options.forEach(option => {
            if (!option.value) return;
            option.hidden = option.getAttribute('data-type') !== selectedType;
        });

        categorySelect.value = "";
    }
</script>

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
