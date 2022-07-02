<?php

namespace App\Infrastructure\Http;

use App\Models\Author;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

final class QSymfonySkeletonApiHttpClient implements QSymfonySkeletonApiInterface
{
    private string $tokenEndpointConfigKey = 'external.q-symfony-api.endpoints.token';
    private string $authorsEndpointConfigKey = 'external.q-symfony-api.endpoints.authors';

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
        $endpoint = config($this->authorsEndpointConfigKey);
        $response = Http::withToken($this->getToken())->get($endpoint);
        $authors = Author::hydrate($response->json('items'));
        return $authors;
    }

    private function getToken(): string
    {
        return Auth::user()->token;
    }
}
