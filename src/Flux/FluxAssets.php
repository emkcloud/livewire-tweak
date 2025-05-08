<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Emkcloud\LivewireTweak\Base\BaseConfig;
use Illuminate\Support\Facades\Blade;

class FluxAssets extends BaseAssets
{
    protected $originalPrefix = '/flux/';

    public function init()
    {
        Blade::anonymousComponentPath(__DIR__.'/../../resources/views/flux/overrides', 'flux');
    }

    public function checkAssetsPrefix(): bool
    {
        return BaseConfig::value(FluxPrefix::ENABLE) == true;
    }

    public function checkAssetsDomain(): bool
    {
        return BaseConfig::value(FluxPrefix::DOMAIN) == true;
    }

    public function getAssetPrefix(): ?string
    {
        return BaseConfig::prefix(FluxPrefix::ASSETS);
    }

    public function bladeAppearance(): string
    {
        return view('livewire-tweak::flux.assets.appearance')->render();
    }

    public function bladeEditorStyles()
    {
        return $this->applyPrefixToHref(app('flux')->editorStyles());
    }

    public function bladeEditorScripts()
    {
        return $this->applyPrefixToSrc(app('flux')->editorScripts());
    }

    public function bladeScripts(): string
    {
        return $this->applyPrefixToSrc($this->bladeScriptsView());
    }

    public function bladeScriptsView(): string
    {
        return view('livewire-tweak::flux.assets.scripts')->render();
    }

    public function startAssetsDirective(): void
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
