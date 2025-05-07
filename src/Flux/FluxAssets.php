<?php

namespace Emkcloud\LivewireTweak\Flux;

use Flux\AssetManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

class FluxAssets
{
    /**
     * Generate environment for flux assets.
     */
    public static function boot()
    {
        Blade::anonymousComponentPath(__DIR__.'/resources/views/overrides', 'flux');
    }

    /**
     * Generate environment for flux assets.
     */
    public static function booted()
    {
        $instance = new static;

        $instance->registerAssetDirective();
        $instance->registerAssetRoutes();
    }

    /**
     * Generate directives for flux assets.
     */
    public function registerAssetDirective(): void
    {
        Blade::directive('livewireTweakFluxAppearance', function ($expression)
        {
            return <<<PHP
            {!! app('livewireTweakFlux')->appearance($expression) !!}
            PHP;
        });

        Blade::directive('livewireTweakFluxScripts', function ($expression)
        {
            return <<<PHP
            {!! app('livewireTweakFlux')->scripts($expression) !!}
            PHP;
        });
    }

    /**
     * Generate routes for flux assets.
     */
    public function registerAssetRoutes(): void
    {
        if (App::routesAreCached())
        {
            return;
        }

        if ($prefix = app('livewireTweakFlux')->getRoutePrefix())
        {
            if (config('livewire-tweak.flux.prefix.enable') == true)
            {
                Route::prefix($prefix)->group(function ()
                {
                    Route::get('flux.js', [AssetManager::class, 'fluxJs']);
                    Route::get('flux.min.js', [AssetManager::class, 'fluxMinJs']);
                    Route::get('editor.css', [AssetManager::class, 'editorCss']);
                    Route::get('editor.js', [AssetManager::class, 'editorJs']);
                    Route::get('editor.min.js', [AssetManager::class, 'editorMinJs']);
                });
            }
        }
    }
}
