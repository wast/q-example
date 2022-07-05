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
    public function fetchAuthorById(int $authorId): Author;
    public function deleteAuthorById(int $authorId): void;

    public function deleteBookById(int $bookId): void;

    public function createBook(array $createBookRequest): void;
}
