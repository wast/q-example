<?php

namespace App\Infrastructure\Http;

use App\Models\Author;

interface QSymfonySkeletonApiInterface
{
    public function validateCredentials(string $email, string $password): bool;
    public function fetchUserByCredentials(string $email, string $password): array;

    /**
     * @return Author[]
     */
    public function fetchAuthors(): array;
}
