<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Illuminate\Support\Facades\Blade;

class FluxAssets extends BaseAssets
{
    protected $constantCustom = FluxCustom::class;

    protected $constantPrefix = FluxPrefix::class;

    protected $originalPrefix = '/flux/';

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

    protected function startAssetsDirective(): void
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
