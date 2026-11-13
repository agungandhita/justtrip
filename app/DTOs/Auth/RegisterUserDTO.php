<?php

namespace App\DTOs\Auth;

use App\Http\Requests\Auth\RegisterRequest;

readonly class RegisterUserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $address,
        public string $password,
    ) {}

    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
            name: (string) $request->validated('name'),
            email: (string) $request->validated('email'),
            phone: (string) $request->validated('phone'),
            address: (string) $request->validated('address'),
            password: (string) $request->validated('password'),
        );
    }
}

