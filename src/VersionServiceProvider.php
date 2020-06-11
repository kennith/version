<?php
namespace Kennith\Version;

use Illuminate\Support\ServiceProvider;
use Kennith\Version\Commands\VersionCommand;
use Kennith\Version\View\Components\VersionComponent;

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

        $this->loadViewsFrom(__DIR__.'/resources/views/version', 'version');
        $this->loadViewComponentsAs('version', [
            VersionComponent::class,
        ]);

        $this->publishes([
            __DIR__.'/../config/version.php' => config_path('version.php'),
            __DIR__.'/resources/views/version' => resource_path('views/vendor/version'),
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
