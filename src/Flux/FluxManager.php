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
        if (config(FluxPrefix::DOMAIN) == true)
        {
            return request()->getSchemeAndHttpHost().$prefix;
        }

        return $prefix;
    }

    public function applyPrefixToHref($output,$prefix): string
    {
        if (config(FluxPrefix::ENABLE) == true && $prefix)
        {
            return preg_replace('#href="/flux/#', 'href="'.$this->applyPrefixDomain($prefix), $output);
        }

        return $output;
    }

    public function applyPrefixToSrc($output,$prefix): string
    {
        if (config(FluxPrefix::ENABLE) == true && $prefix)
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
        return view('livewire-tweak::flux.assets.appearance')->render();
    }

    public function getAssetPrefix(): ?string
    {
        return $this->getConfigPrefix(FluxPrefix::ASSETS);
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
        return $this->getConfigPrefix(FluxPrefix::ROUTES);
    }

    public function getScriptView(): string
    {
        return view('livewire-tweak::flux.assets.scripts')->render();
    }
}
