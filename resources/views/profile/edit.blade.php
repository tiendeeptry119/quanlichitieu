@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">⚙️ Cài Đặt Tài Khoản</h2>

    {{-- Hiển thị thông báo --}}
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Cập nhật thông tin --}}
    <div class="card mb-5 shadow rounded-4">
        <div class="card-header bg-light fw-bold">👤 Thông Tin Cá Nhân</div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label">Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
            </form>
        </div>
    </div>

    {{-- Đổi mật khẩu --}}
    <div class="card shadow rounded-4">
        <div class="card-header bg-light fw-bold">🔒 Đổi Mật Khẩu</div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning">🔁 Đổi mật khẩu</button>
            </form>
        </div>
    </div>
</div>
@endsection
