<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->input('email'))->first();

        if (! $user) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Email không tồn tại trong hệ thống.',
            ]);
        }

        if (! Hash::check($this->input('password'), $user->password)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => 'Mật khẩu không chính xác.',
            ]);
        }

        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => "Bạn đã đăng nhập quá nhiều lần. Vui lòng thử lại sau $seconds giây.",
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::lower($this->input('email')) . '|' . $this->ip();
    }
}
