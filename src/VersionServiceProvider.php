<?php
namespace Kennith\Version;

use Illuminate\Support\ServiceProvider;
use Kennith\Version\Commands\VersionCommand;

/**
 * Version Service Provider
 */
class VersionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                VersionCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/version.php' => config_path('version.php')
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/version.php',
            'version'
        );
    }
}
