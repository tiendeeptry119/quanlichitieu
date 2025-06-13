<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Thêm dòng này -->
  <title>Quản Lý Danh Mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fc;
    }
    .card-hover:hover {
      transform: translateY(-3px);
      transition: 0.3s ease;
    }
  </style>
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4 text-primary fw-bold">📁 Quản Lý Danh Mục</h2>

  <div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">← Quay về Trang Chủ</a>
    <a href="{{ route('categories.create') }}" class="btn btn-success">+ Thêm Danh Mục</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm card-hover">
    <div class="card-body p-0">
      <div class="table-responsive"> <!-- Thêm để xử lý mobile -->
        <table class="table table-hover mb-0">
          <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Tên danh mục</th>
            <th>Loại</th>
            <th class="text-end">Hành động</th>
          </tr>
          </thead>
          <tbody>
          @forelse($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>
                <span class="badge {{ $category->type === 'income' ? 'bg-success' : 'bg-danger' }}">
                  {{ $category->type === 'income' ? 'Thu' : 'Chi' }}
                </span>
              </td>
              <td class="text-end">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                  @csrf @method('DELETE')
                  <button onclick="return confirm('Xóa danh mục này?')" class="btn btn-sm btn-danger">Xóa</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-4">Chưa có danh mục nào.</td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
