<?php

namespace Emkcloud\LivewireTweak\Providers;

use Emkcloud\LivewireTweak\Core\CoreAssets;
use Emkcloud\LivewireTweak\Core\CoreRoutes;
use Emkcloud\LivewireTweak\Flux\FluxAssets;
use Emkcloud\LivewireTweak\Flux\FluxRoutes;
use Flux\FluxServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\LivewireServiceProvider;
use Livewire\Mechanisms\HandleRequests\HandleRequests;
use Composer\InstalledVersions;

class LivewireTweakServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerBinding();
    }

    protected function registerBinding()
    {
        $this->app->alias(CoreAssets::class, 'livewireTweakCoreAssets');
        $this->app->alias(CoreRoutes::class, 'livewireTweakCoreRoutes');

        $this->app->alias(FluxAssets::class, 'livewireTweakFluxAssets');
        $this->app->alias(FluxRoutes::class, 'livewireTweakFluxRoutes');

        $this->app->singleton(CoreAssets::class);
        $this->app->singleton(CoreRoutes::class);

        $this->app->singleton(FluxAssets::class);
        $this->app->singleton(FluxRoutes::class);
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

    public function boot(): void
    {
        $this->startInit();
        $this->startSetting();
    }

    public function startInit(): void
    {
        app('livewireTweakCoreRoutes')->init();
        app('livewireTweakFluxRoutes')->init();
        app('livewireTweakCoreAssets')->init();
        app('livewireTweakFluxAssets')->init();
    }

    public function startSetting(): void
    {
        App::booted(function ()
        {
            $this->startSettingCore();
            $this->startSettingFlux();
        });
    }

    public function startSettingCore(): void
    {
        $directives = app('blade.compiler')->getCustomDirectives();

        if (app()->getProvider(LivewireServiceProvider::class))
        {
            if (isset($directives['livewireStyles']) && isset($directives['livewireScripts']))
            {
                app('livewireTweakCoreRoutes')->start();
                app('livewireTweakCoreAssets')->start();
            }
        }
    }

    public function startSettingFlux(): void
    {
        $directives = app('blade.compiler')->getCustomDirectives();

        if (app()->getProvider(FluxServiceProvider::class))
        {
            if (isset($directives['fluxAppearance']) && isset($directives['fluxScripts']))
            {
                app('livewireTweakFluxRoutes')->start();
                app('livewireTweakFluxAssets')->start();
            }
        }
    }
}
