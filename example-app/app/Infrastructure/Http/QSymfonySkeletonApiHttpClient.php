<?php

namespace App\Infrastructure\Http;

use Illuminate\Support\Facades\Http;

final class QSymfonySkeletonApiHttpClient implements QSymfonySkeletonApiInterface
{
    private string $getTokenEndpoint = 'https://symfony-skeleton.q-tests.com/api/v2/token';

    public function validateCredentials(string $email, string $password): bool
    {
        $requestBody = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post($this->getTokenEndpoint, $requestBody);
        return $response->ok();
    }

    public function fetchUser(string $email, string $password): array
    {
        $requestBody = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post($this->getTokenEndpoint, $requestBody);

        if ($response->failed()) {
            return [];
        }

        return [
            'token' => $response['token_key'],
            'user' => $response['user'],
        ];
    }
}
