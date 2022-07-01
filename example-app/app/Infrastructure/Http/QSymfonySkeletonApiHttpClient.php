<?php

namespace App\Infrastructure\Http;

use Illuminate\Support\Facades\Http;

final class QSymfonySkeletonApiHttpClient implements QSymfonySkeletonApiInterface
{
    private string $tokenEndpointConfigKey = 'external.q-symfony-api.endpoints.token';

    public function validateCredentials(string $email, string $password): bool
    {
        $requestBody = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post(config($this->tokenEndpointConfigKey), $requestBody);
        return $response->ok();
    }

    public function fetchUser(string $email, string $password): array
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
}
