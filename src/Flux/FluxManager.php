<?php

namespace Emkcloud\LivewireTweak\Flux;

use Illuminate\Support\Str;

class FluxManager
{
    public function appearance(): string
    {
        return $this->getAppearanceView();
    }

    public function applyPrefixDomain($prefix): string
    {
        if (config('livewire-tweak.flux.prefix.domain') == true)
        {
            return request()->getSchemeAndHttpHost().$prefix;
        }

        return $prefix;
    }

    public function applyPrefixToHref($output,$prefix): string
    {
        if (config('livewire-tweak.flux.prefix.enable') == true && $prefix)
        {
            return preg_replace('#href="/flux/#', 'href="'.$this->applyPrefixDomain($prefix), $output);
        }

        return $output;
    }

    public function applyPrefixToSrc($output,$prefix): string
    {
        if (config('livewire-tweak.flux.prefix.enable') == true && $prefix)
        {
            return preg_replace('#src="/flux/#', 'src="'.$this->applyPrefixDomain($prefix), $output);
        }

        return $output;
    }

    public function scripts(): string
    {
        return $this->applyPrefixToSrc($this->getScriptView(),$this->getAssetPrefix());
    }

    public function editorStyles()
    {
        return $this->applyPrefixToHref(app('flux')->editorStyles(),$this->getAssetPrefix());
    }

    public function editorScripts()
    {
        return $this->applyPrefixToSrc(app('flux')->editorScripts(),$this->getAssetPrefix());
    }

    public function getAppearanceView(): string
    {
        return view()->file(__DIR__.'/resources/views/assets/appearance.blade.php')->render();
    }

    public function getAssetPrefix(): ?string
    {
        return $this->getConfigPrefix('livewire-tweak.flux.prefix.assets');
    }

    public function getConfigPrefix($config): ?string
    {
        if ($prefix = Str::trim(config($config)))
        {
            return Str::start(Str::finish($prefix, '/'), '/');
        }

        return null;
    }

    public function getRoutePrefix(): ?string
    {
        return $this->getConfigPrefix('livewire-tweak.flux.prefix.routes');
    }

    public function getScriptView(): string
    {
        return view()->file(__DIR__.'/resources/views/assets/scripts.blade.php')->render();
    }
}
