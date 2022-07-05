<?php

namespace App\Infrastructure\Http;

use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

final class QSymfonySkeletonApiHttpClient implements QSymfonySkeletonApiInterface
{
    private string $tokenEndpointConfigKey = 'external.q-symfony-api.endpoints.token';
    private string $authorsEndpointConfigKey = 'external.q-symfony-api.endpoints.authors';
    private string $booksEndpointConfigKey = 'external.q-symfony-api.endpoints.books';

    public function validateCredentials(string $email, string $password): bool
    {
        $requestBody = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post(config($this->tokenEndpointConfigKey), $requestBody);
        return $response->ok();
    }

    public function fetchUserByCredentials(string $email, string $password): array
    {
        $requestBody = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post(config($this->tokenEndpointConfigKey), $requestBody);

        if ($response->failed()) {
            return [];
        }

        return [
            'token' => $response['token_key'],
            'user' => $response['user'],
        ];
    }

    /**
     * @return Author[]
     */
    public function fetchAuthors(): array
    {
        $endpoint = config($this->authorsEndpointConfigKey) . '?limit=1000'; // TODO pagination
        $response = Http::withToken($this->getToken())->get($endpoint);
        $authors = Author::hydrate($response->json('items'));
        return $authors;
    }

    public function fetchAuthorById(int $authorId): Author
    {
        $endpoint = config($this->authorsEndpointConfigKey) . "/$authorId";
        $response = Http::withToken($this->getToken())->get($endpoint);
        $author = Author::fromJson($response->json());
        return $author;
    }

    public function deleteAuthorById(int $authorId): void
    {
        $endpoint = config($this->authorsEndpointConfigKey) . "/$authorId";
        Http::withToken($this->getToken())->delete($endpoint);
    }

    public function deleteBookById(int $bookId): void
    {
        $endpoint = config($this->booksEndpointConfigKey) . "/$bookId";
        Http::withToken($this->getToken())->delete($endpoint);
    }

    public function createBook(array $createBookRequest): void
    {
        $endpoint = config($this->booksEndpointConfigKey);
        $data = [
            'author' => [
                'id' => (int) $createBookRequest['authorId'],
            ],
            'title' => $createBookRequest['title'],
            'release_date' => $createBookRequest['releaseDate'],
            'description' => $createBookRequest['description'],
            'isbn' => $createBookRequest['isbn'],
            'format' => $createBookRequest['bookFormat'],
            'number_of_pages' => (int) $createBookRequest['numberOfPages'],
        ];
        Http::withToken($this->getToken())->post($endpoint, $data);
    }

    private function getToken(): string
    {
        return Auth::user()->token;
    }
}
