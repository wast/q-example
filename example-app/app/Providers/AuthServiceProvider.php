<?php

namespace App\Providers;

use App\Infrastructure\Http\QSymfonySkeletonApiHttpClient;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('q-symfony-skeleton-api', function ($app, array $config) {
            return new QSymfonySkeletonUserProvider($app->make(QSymfonySkeletonApiHttpClient::class));
        });
    }
}
