@extends('layouts.app')

@section('content')
<div class="container py-5" style="background: #f0f2f5;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center text-primary mb-4">🔑 Quên Mật Khẩu</h3>

                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">📧 Nhập địa chỉ email của bạn</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control rounded-pill px-4 @error('email') is-invalid @enderror"
                                   placeholder="example@gmail.com"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary rounded-pill py-2">
                                Gửi liên kết đặt lại mật khẩu
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
