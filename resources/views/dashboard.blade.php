@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="text-primary">👋 Xin chào, {{ Auth::user()->name }}!</h2>
        <p class="text-muted">Chúc bạn một ngày quản lý thu chi hiệu quả 🎯</p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Giao dịch -->
        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 text-center p-4 h-100 hover-shadow">
                    <div class="fs-2 mb-2">📋</div>
                    <h5 class="text-primary">Quản Lý Giao Dịch</h5>
                    <p class="text-muted small mb-0">Xem, thêm, sửa hoặc lọc giao dịch chi tiêu của bạn.</p>
                </div>
            </a>
        </div>

        <!-- Danh mục -->
        <div class="col-md-4">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 text-center p-4 h-100">
                    <div class="fs-2 mb-2">🗂</div>
                    <h5 class="text-success">Quản Lý Danh Mục</h5>
                    <p class="text-muted small mb-0">Phân loại thu - chi theo nhóm cho dễ quản lý.</p>
                </div>
            </a>
        </div>

        <!-- Cài đặt -->
        <div class="col-md-4">
            <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                <div class="card border-0 shadow rounded-4 text-center p-4 h-100">
                    <div class="fs-2 mb-2">⚙️</div>
                    <h5 class="text-dark">Cài Đặt Tài Khoản</h5>
                    <p class="text-muted small mb-0">Cập nhật thông tin cá nhân, đổi mật khẩu, ...</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection