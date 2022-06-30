<?php

namespace App\Providers;

use App\Infrastructure\Http\QSymfonySkeletonApiHttpClient;
use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class QSymfonySkeletonUserProvider implements UserProvider
{
    private QSymfonySkeletonApiInterface $qSymfonySkeletonApi;

    public function __construct(QSymfonySkeletonApiInterface $qSymfonySkeletonApi)
    {
        $this->qSymfonySkeletonApi = $qSymfonySkeletonApi;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $responseUser = $this->qSymfonySkeletonApi->fetchUser($credentials['email'], $credentials['password']);

        if (empty($responseUser)) {
            return null;
        }

        return (new User())
            ->setEmail($responseUser['user']['email'])
            ->setFirstName($responseUser['user']['first_name'])
            ->setLastName($responseUser['user']['last_name'])
            ->setToken($responseUser['token']);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return $this->qSymfonySkeletonApi->validateCredentials($credentials['email'], $credentials['password']);
    }
}
