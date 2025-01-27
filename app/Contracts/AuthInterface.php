<?php

namespace App\Contracts;

interface AuthInterface
{
    public function login(string $email, string $password): ?string;
    public function generateToken(int $adminId): string;
    public function authenticate(string $token): bool;
    public function getLoggedInAdminName(): ?string;
}
