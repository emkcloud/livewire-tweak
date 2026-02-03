<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

class FluxAssets extends BaseAssets
{
    protected $prefixConstant = FluxPrefix::class;

    protected $prefixOriginal = 'flux';

    protected $prefixVariable = '{assetsflux}';

    protected $middlewareConstant = FluxMiddleware::class;

    public function init()
    {
        Blade::anonymousComponentPath(__DIR__.'/../../resources/views/flux/overrides', 'flux');
    }

    public function bladeAppearance(): string
    {
        return view('livewire-tweak::flux.assets.appearance')->render();
    }

    public function bladeEditorStyles()
    {
        return $this->replaceTagHref(
            $this->bladeReplaceDomain(app('flux')->editorStyles()));
    }

    public function bladeEditorScripts()
    {
        return $this->replaceTagSrc(
            $this->bladeReplaceDomain(app('flux')->editorScripts()));
    }

    public function bladeScripts(): string
    {
        return $this->replaceTagSrc($this->bladeReplaceDomain(
            view('livewire-tweak::flux.assets.scripts')->render()));
    }

    public function bladeReplaceDomain($output): string
    {
        return Str::replace(Str::trim(url('/'),'/'),'',$output);
    }

    protected function startAssetsPrefixAddon(): void
    {
        Blade::directive('livewireTweakFluxAppearance', function ($expression)
        {
            return <<<PHP
            {!! app('livewireTweakFluxAssets')->bladeAppearance($expression) !!}
            PHP;
        });

        Blade::directive('livewireTweakFluxScripts', function ($expression)
        {
            return <<<PHP
            {!! app('livewireTweakFluxAssets')->bladeScripts($expression) !!}
            PHP;
        });
    }
}
