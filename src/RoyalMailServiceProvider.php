<?php

declare(strict_types=1);

namespace MobiMarket\RoyalMailShipping;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use MobiMarket\RoyalMailShipping\Entities\ApiAuth;

class RoyalMailServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @deprecated
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/royalmail.php' => config_path('royalmail.php'),
        ], 'royalmail');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/royalmail.php', 'royalmail');

        $this->app->singleton(RoyalMailRestApi::class, function (Application $app) {
            $config = $app->make('config');

            return new RoyalMailRestApi(
                $config->get('royalmail.api.url'),
                $config->get('royalmail.api.timeout'),
                $config->get('royalmail.api.should_log'),
                $config->get('royalmail.api.token_cache_ttl'),
                ApiAuth::fromArray($config->get('royalmail.auth'))
            );
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [RoyalMailRestApi::class];
    }
}
