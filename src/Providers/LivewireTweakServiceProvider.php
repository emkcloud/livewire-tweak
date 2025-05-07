<?php

namespace Emkcloud\LivewireTweak\Providers;

use Emkcloud\LivewireTweak\Core\CoreManager;
use Emkcloud\LivewireTweak\Flux\FluxAssets;
use Emkcloud\LivewireTweak\Flux\FluxManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class LivewireTweakServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        App::booted(function ()
        {
            $directives = app('blade.compiler')->getCustomDirectives();

            if ($this->app->getProvider(\Flux\FluxServiceProvider::class))
            {
                if (isset($directives['fluxScripts']) && isset($directives['fluxAppearance']))
                {
                    FluxAssets::boot();
                }
            }
        });
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerBinding();
    }

    /**
     * Register the binding classes.
     */
    protected function registerBinding()
    {
        $this->app->alias(CoreManager::class, 'livewireTweakCore');
        $this->app->alias(FluxManager::class, 'livewireTweakFlux');

        $this->app->singleton(CoreManager::class);
        $this->app->singleton(FluxManager::class);
    }

    /**
     * Register the general configuration.
     */
    protected function registerConfig()
    {
        $config = __DIR__.'/../../config/livewire-tweak.php';

        $this->publishes([$config => config_path('livewire-tweak.php')], ['livewire-tweak', 'livewire-tweak:config']);

        $this->mergeConfigFrom($config, 'livewire-tweak');
    }
}
