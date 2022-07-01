<?php

namespace App\Infrastructure\Http;

interface QSymfonySkeletonApiInterface
{
    public function validateCredentials(string $email, string $password): bool;
    public function fetchUserByCredentials(string $email, string $password): array;
}
