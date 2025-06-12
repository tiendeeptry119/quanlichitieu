<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Giao Dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">➕ Thêm Giao Dịch Mới</h2>

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
        <input type="number" name="amount" class="form-control" required>
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
    <div class="mb-3 d-flex align-items-end gap-2">
        <div class="flex-grow-1">
            <label class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-type="{{ $category->type }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-outline-success">➕</a>
    </div>

    <!-- Ngày -->
    <div class="mb-3">
        <label class="form-label">Ngày</label>
        <input type="date" name="date" class="form-control" value="{{ now()->toDateString() }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Lưu giao dịch</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
</form>

<script>
    function filterCategories() {
        const type = document.getElementById('type').value;
        const categorySelect = document.getElementById('category_id');
        const options = categorySelect.querySelectorAll('option');

        options.forEach(option => {
            if (!option.value) return; // giữ option mặc định
            option.hidden = option.getAttribute('data-type') !== type;
        });

        categorySelect.value = "";
    }
</script>


<script>
    function filterCategories() {
        const selectedType = document.getElementById('type').value;
        const categorySelect = document.getElementById('category_id');
        const options = categorySelect.querySelectorAll('option');

        options.forEach(option => {
            if (!option.value) return; // Bỏ option mặc định
            option.hidden = option.getAttribute('data-type') !== selectedType;
        });

        categorySelect.value = ""; // reset chọn lại
    }
</script>
</body>
</html>
