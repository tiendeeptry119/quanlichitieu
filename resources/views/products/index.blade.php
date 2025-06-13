<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Thu Chi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background: linear-gradient(to right, #f8fbff, #e0efff);
      min-height: 100vh;
    }
    .card {
      border-radius: 1rem;
      transition: all 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }
    .btn-primary, .btn-success, .btn-danger {
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .section-title {
      background: linear-gradient(90deg, #007bff, #00c6ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>
<body>
<div class="container py-5">

<h1 class="text-center fw-bold mb-5">
  <span style="font-size: 2.2rem;">📋</span>
  <span class="text-primary" style="font-size: 2.5rem;">Quản Lý Thu Chi</span>
</h1>

<div class="d-flex justify-content-between flex-wrap gap-2 mb-4">
  <a href="{{ route('categories.index') }}" class="btn btn-outline-dark btn-sm">📁 Quản Lý Danh Mục</a>
  <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">+ Thêm Giao Dịch</a>
  <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">⚙️ Cài Đặt Tài Khoản</a>
  <a href="{{ route('products.balance') }}" class="btn btn-outline-info btn-sm">💼 Nhập Số Dư Ban Đầu</a>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-outline-danger btn-sm">Đăng xuất</button>
  </form>
</div>

<!-- Form lọc -->
<form method="GET" action="{{ route('products.index') }}" class="row g-3 mb-5 bg-white p-4 rounded shadow-sm border border-2">
  <div class="col-md-4">
    <label class="form-label fw-semibold text-primary">📅 Lọc theo tháng/năm</label>
    <input type="month" name="month" class="form-control" value="{{ request('month') }}">
  </div>
  <div class="col-md-4 align-self-end">
    <div class="btn-group w-100">
      <a href="{{ route('products.index') }}" class="btn btn-outline-dark {{ request('type') == '' ? 'active' : '' }}">📋 Tất cả</a>
      <a href="{{ route('products.index', array_merge(request()->all(), ['type' => 'income'])) }}" class="btn btn-outline-success {{ request('type') == 'income' ? 'active' : '' }}">✅ Thu</a>
      <a href="{{ route('products.index', array_merge(request()->all(), ['type' => 'expense'])) }}" class="btn btn-outline-danger {{ request('type') == 'expense' ? 'active' : '' }}">❌ Chi</a>
    </div>
  </div>
  <div class="col-md-4 align-self-end d-flex gap-2">
    <button type="submit" class="btn btn-success w-100">🔍 Lọc</button>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100">🔄 Xóa lọc</a>
  </div>
</form>

<!-- Tổng quan -->
<div class="row text-center mb-5 g-4">
  <div class="col-md-3">
    <div class="card text-white bg-gradient bg-secondary">
      <div class="card-body">
        <h5 class="card-title">💼 Số Dư Ban Đầu</h5>
        <p class="fs-4 fw-bold">{{ number_format($initialBalance, 0, ',', '.') }} ₫</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-gradient bg-success">
      <div class="card-body">
        <h5 class="card-title">✅ Tổng Thu</h5>
        <p class="fs-4 fw-bold">{{ number_format($totalIncome, 0, ',', '.') }} ₫</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-gradient bg-danger">
      <div class="card-body">
        <h5 class="card-title">❌ Tổng Chi</h5>
        <p class="fs-4 fw-bold">{{ number_format($totalExpense, 0, ',', '.') }} ₫</p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card text-white bg-gradient bg-primary">
      <div class="card-body">
        <h5 class="card-title">💰 Số Dư Hiện Tại</h5>
        <p class="fs-4 fw-bold">{{ number_format($balance, 0, ',', '.') }} ₫</p>
      </div>
    </div>
  </div>
</div>

<!-- Giao dịch -->
<div class="card shadow-lg border-0 mb-5">
  <div class="card-header bg-gradient bg-dark text-white">
    📋 Danh sách giao dịch
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>📅 Ngày</th>
          <th>📌 Loại</th>
          <th>📝 Tiêu đề</th>
          <th>📁 Danh mục</th>
          <th class="text-end">💸 Số tiền</th>
          <th class="text-center">⚙️ Hành động</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
          <tr>
            <td>{{ $product->date }}</td>
            <td><span class="badge {{ $product->type === 'income' ? 'bg-success' : 'bg-danger' }}">{{ $product->type === 'income' ? 'Thu' : 'Chi' }}</span></td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->category->name ?? '-' }}</td>
            <td class="text-end">{{ number_format($product->amount, 0, ',', '.') }} ₫</td>
            <td class="text-center">
              <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
              <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-sm btn-danger">Xóa</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">Chưa có giao dịch nào.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- Biểu đồ tròn -->
<div class="card shadow-lg border-0">
  <div class="card-header text-center bg-info text-white fw-semibold">📊 Tỷ lệ Thu vs Chi</div>
  <div class="card-body">
    <canvas id="pieChart" style="max-width: 300px; margin: auto;"></canvas>
  </div>
</div>

</div>

<script>
  const ctx = document.getElementById('pieChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Thu', 'Chi'],
      datasets: [{
        data: [{{ $totalIncome }}, {{ $totalExpense }}],
        backgroundColor: ['#28a745', '#dc3545'],
        hoverOffset: 10
      }]
    },
    options: {
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
</body>
<p class="text-center text-muted small mt-5">
    © Nocopyright • Built by <strong>Phạm Trần Tiến</strong> ✌️
</p>
</html>
