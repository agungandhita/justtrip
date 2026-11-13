<?php

namespace App\Services\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthService implements AuthServiceInterface
{
    /**
     * Maximum failed login attempts allowed before lockout.
     */
    protected const MAX_ATTEMPTS = 5;

    /**
     * Lockout decay time in seconds (1 minute).
     */
    protected const DECAY_SECONDS = 60;

    /**
     * {@inheritDoc}
     */
    public function isLockedOut(string $email, string $ip): bool
    {
        return RateLimiter::tooManyAttempts($this->throttleKey($email, $ip), self::MAX_ATTEMPTS);
    }

    /**
     * {@inheritDoc}
     */
    public function availableIn(string $email, string $ip): int
    {
        return RateLimiter::availableIn($this->throttleKey($email, $ip));
    }

    /**
     * {@inheritDoc}
     */
    public function login(LoginDTO $dto, string $ip): bool
    {
        $key = $this->throttleKey($dto->email, $ip);

        if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
            return false;
        }

        $credentials = [
            'email'    => $dto->email,
            'password' => $dto->password,
        ];

        if (Auth::attempt($credentials, $dto->remember)) {
            RateLimiter::clear($key);
            request()->session()->regenerate();

            return true;
        }

        RateLimiter::hit($key, self::DECAY_SECONDS);

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function register(RegisterUserDTO $dto): User
    {
        $user = User::create([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'phone'    => $dto->phone,
            'address'  => $dto->address,
            'password' => Hash::make($dto->password),
            'role'     => 'user',
        ]);

        Auth::login($user);

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function logout(): void
    {
        Auth::logout();

        if (request()->hasSession()) {
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
    }

    /**
     * Generate the throttle cache key for the given email and IP.
     */
    protected function throttleKey(string $email, string $ip): string
    {
        return Str::transliterate(Str::lower(trim($email)) . '|' . $ip);
    }
}

