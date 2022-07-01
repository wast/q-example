<?php

namespace App\Providers;

use App\Infrastructure\Http\QSymfonySkeletonApiInterface;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Cache;

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
        $user = Cache::get("user$identifier");
        return $user;
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
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {}

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $responseUser = $this->qSymfonySkeletonApi->fetchUserByCredentials($credentials['email'], $credentials['password']);

        if (empty($responseUser)) {
            return null;
        }

        $user = new User([
            'id' => (int) $responseUser['user']['id'],
            'email' => $responseUser['user']['email'],
            'firstName' => $responseUser['user']['first_name'],
            'lastName' => $responseUser['user']['last_name'],
            'name' => $responseUser['user']['first_name'] . ' ' . $responseUser['user']['last_name'],
            'token' => $responseUser['token'],
        ]);

        Cache::put("user$user->id", $user);
        return $user;
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
        // TODO Validate a user against the given credentials.
//        $user->getAuthIdentifier()
        return $this->qSymfonySkeletonApi->validateCredentials($credentials['email'], $credentials['password']);
    }
}
