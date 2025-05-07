<?php

namespace Emkcloud\LivewireTweak\Flux;

use Flux\AssetManager;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class FluxRoutes
{
    protected $originalRoutes =
    [
        'flux/flux.js',
        'flux/flux.min.js',
        'flux/editor.css',
        'flux/editor.js',
        'flux/editor.min.js'
    ];

    public static function booted()
    {
        if (! App::routesAreCached())
        {
            $instance = new static;
            $instance->registerRoutes();
        }
    }

    public function registerRoutes(): void
    {
        if (config(FluxPrefix::ENABLE) == true)
        {
            $this->registerRoutesPrefix();
        }

        if (config(FluxPrefix::REMOVE) == true)
        {
            $this->registerRoutesRemove();
        }
    }

    public function registerRoutesPrefix(): void
    {
        if ($prefix = app('livewireTweakFlux')->getRoutePrefix())
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

    public function registerRoutesRemove(): void
    {
        if (app('livewireTweakFlux')->getRoutePrefix())
        {
            $routes = new RouteCollection();

            foreach (app()->router->getRoutes() as $route)
            {
                if (!in_array($route->uri(),$this->originalRoutes))
                {
                    $routes->add($route);
                }
            }

            app()->router->setRoutes($routes);
        }
    }
}
