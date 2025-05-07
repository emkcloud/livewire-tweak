<?php

namespace Emkcloud\LivewireTweak\Flux;

use Illuminate\Support\Facades\Blade;

class FluxAssets
{
    public static function boot()
    {
        $instance = new static;

        $instance->registerAssetDirective();
        $instance->registerAssetRoutes();
    }

    public function registerAssetDirective()
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

    public function registerAssetRoutes() {}
}
