<?php

namespace Emkcloud\LivewireTweak\Flux;

use Illuminate\Support\Facades\Blade;

class FluxAssets
{
    public static function boot()
    {
        Blade::anonymousComponentPath(__DIR__.'/../../resources/views/flux/overrides', 'flux');
    }

    public static function booted()
    {
        $instance = new static;

        $instance->registerAssetDirective();
    }

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
}
