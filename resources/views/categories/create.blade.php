<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Thêm dòng này -->
    <title>Thêm Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">

<div class="container py-5 d-flex justify-content-center">
    <div class="col-12 col-md-6"> <!-- Responsive container -->

        <h3 class="mb-4 text-center">➕ Thêm Danh Mục Mới</h3>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <!-- Tên danh mục -->
            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- Loại -->
            <div class="mb-3">
                <label class="form-label">Loại</label>
                <select name="type" class="form-select" required>
                    <option value="income">Thu</option>
                    <option value="expense">Chi</option>
                </select>
            </div>

            <!-- Nút -->
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>

    </div>
</div>

</body>
</html>
