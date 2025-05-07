<?php

namespace Emkcloud\LivewireTweak\Providers;

use Emkcloud\LivewireTweak\Core\CoreManager;
use Emkcloud\LivewireTweak\Flux\FluxAssets;
use Emkcloud\LivewireTweak\Flux\FluxManager;
use Emkcloud\LivewireTweak\Flux\FluxRoutes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class LivewireTweakServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootInit();
        $this->bootComplete();
    }

    public function bootInit(): void
    {
        FluxAssets::boot();
    }

    public function bootComplete(): void
    {
        App::booted(function ()
        {
            $directives = app('blade.compiler')->getCustomDirectives();

            if ($this->app->getProvider(\Flux\FluxServiceProvider::class))
            {
                if (isset($directives['fluxScripts']) && isset($directives['fluxAppearance']))
                {
                    FluxAssets::booted();
                    FluxRoutes::booted();
                }
            }
        });
    }

    public function register(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerBinding();
    }

    protected function registerBinding()
    {
        $this->app->alias(CoreManager::class, 'livewireTweakCore');
        $this->app->alias(FluxManager::class, 'livewireTweakFlux');

        $this->app->singleton(CoreManager::class);
        $this->app->singleton(FluxManager::class);
    }

    protected function registerConfig()
    {
        $config = __DIR__.'/../../config/livewire-tweak.php';

        $this->publishes([$config => config_path('livewire-tweak.php')], ['livewire-tweak', 'livewire-tweak:config']);

        $this->mergeConfigFrom($config, 'livewire-tweak');
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'livewire-tweak');
    }
}
