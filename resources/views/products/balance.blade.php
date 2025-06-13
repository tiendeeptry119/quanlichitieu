@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">💼 Cập Nhật Số Dư Ban Đầu</h2>

    <form id="balance-form" action="{{ route('products.balance') }}" method="POST" class="bg-white p-4 shadow rounded border border-2">
        @csrf

        <!-- Số dư ban đầu -->
        <div class="mb-3">
            <label for="initial_balance" class="form-label">Số dư ban đầu (₫)</label>
            <input type="text" name="initial_balance" id="initial_balance"
                   class="form-control" required pattern="[\d,]+"
                   value="{{ old('initial_balance') 
                        ? number_format((int)str_replace(',', '', old('initial_balance')), 0, '.', ',') 
                        : number_format($user->initial_balance, 0, '.', ',') }}">
        </div>

        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const input = document.getElementById('initial_balance');
    const form = document.getElementById('balance-form');

    // Format khi gõ
    input.addEventListener('input', function () {
        let raw = input.value.replace(/,/g, '').replace(/[^\d]/g, '');
        if (raw.length > 0) {
            input.value = Number(raw).toLocaleString('en-US'); // => 1,234,567
        } else {
            input.value = '';
        }
    });

    // Trước khi submit: loại dấu phẩy
    form.addEventListener('submit', function () {
        input.value = input.value.replace(/,/g, '');
    });
</script>
@endpush
