<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Biểu Đồ Thu Chi</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">

<div class="container py-5">
    <h2 class="mb-4">📊 Biểu Đồ Tròn: Tổng Thu vs Chi</h2>

    <div class="d-flex justify-content-center">
<div style="max-width: 300px; width: 100%; background: #fff; padding: 1rem; border-radius: 1rem; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <canvas id="pieChart"></canvas>
</div>
    </div>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-4">← Quay lại</a>
</div>

<script>
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Thu', 'Chi'],
            datasets: [{
                data: [{{ $income }}, {{ $expense }}],
                backgroundColor: ['#198754', '#dc3545'],
                hoverOffset: 10
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>

</body>
</html>
