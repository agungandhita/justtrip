<?php

namespace App\DTOs\Auth;

use App\Http\Requests\Auth\LoginRequest;

readonly class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false,
    ) {}

    public static function fromRequest(LoginRequest $request): self
    {
        return new self(
            email: (string) $request->validated('email'),
            password: (string) $request->validated('password'),
            remember: (bool) $request->boolean('remember'),
        );
    }
}

