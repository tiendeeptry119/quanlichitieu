@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f0f2f5;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center text-success mb-4">🔒 Đặt Lại Mật Khẩu</h3>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
 @method('PUT')
                        {{-- Token --}}
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">📧 Email</label>
                            <input id="email" type="email"
                                   class="form-control rounded-pill px-4 @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email', request('email')) }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">🔑 Mật khẩu mới</label>
                            <input id="password" type="password"
                                   class="form-control rounded-pill px-4 @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">🔁 Nhập lại mật khẩu</label>
                            <input id="password_confirmation" type="password"
                                   class="form-control rounded-pill px-4"
                                   name="password_confirmation" required>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success rounded-pill py-2">
                                Cập Nhật Mật Khẩu
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">← Quay lại đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
