<?php

namespace App\Services\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterUserDTO;
use App\Models\User;

interface AuthServiceInterface
{
    /**
     * Authenticate user with rate limiting and lockout protection.
     */
    public function login(LoginDTO $dto, string $ip): bool;

    /**
     * Register a new user and log them in.
     */
    public function register(RegisterUserDTO $dto): User;

    /**
     * Log out current session and invalidate token.
     */
    public function logout(): void;

    /**
     * Check if email + IP is currently locked out from login attempts.
     */
    public function isLockedOut(string $email, string $ip): bool;

    /**
     * Get remaining lockout duration in seconds.
     */
    public function availableIn(string $email, string $ip): int;
}

