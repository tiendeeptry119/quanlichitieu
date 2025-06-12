<!DOCTYPE html>
<html>
<head>
    <title>Sửa Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
<div class="container py-5">
    <h3 class="mb-4">✏️ Sửa Danh Mục</h3>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên danh mục</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Loại</label>
            <select name="type" class="form-select" required>
                <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Thu</option>
                <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Chi</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
</body>
</html>
