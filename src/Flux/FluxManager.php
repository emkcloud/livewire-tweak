<?php

namespace Emkcloud\LivewireTweak\Flux;

use Illuminate\Support\Str;

class FluxManager
{
    /**
     * Generate Blade directive appearance.
     */
    public function appearance(): string
    {
        return $this->getAppearanceView();
    }

    /**
     * Add prefix on original path (href) assets.
     */
    public function applyPrefixToHref($output,$prefix): string
    {
        return ($prefix) ? preg_replace('#href="/flux/#', 'href="'.$prefix, $output) : $output;
    }

    /**
     * Add prefix on original path (src) assets.
     */
    public function applyPrefixToSrc($output,$prefix): string
    {
        return ($prefix) ? preg_replace('#src="/flux/#', 'src="'.$prefix, $output) : $output;
    }

    /**
     * Generate Blade directive scripts.
     */
    public function scripts(): string
    {
        return $this->applyPrefixToSrc($this->getAssetView(),$this->getAssetPrefix());
    }

    /**
     * Override original Flux editorStyles.
     */
    public function editorStyles()
    {
        return $this->applyPrefixToHref(app('flux')->editorStyles(),$this->getAssetPrefix());
    }

    /**
     * Override original Flux editorScripts.
     */
    public function editorScripts()
    {
        return $this->applyPrefixToSrc(app('flux')->editorScripts(),$this->getAssetPrefix());
    }

    /**
     * Load and render the appearance view.
     */
    public function getAppearanceView(): string
    {
        return view()->file(__DIR__.'/resources/views/assets/appearance.blade.php')->render();
    }

    /**
     * Get the configured asset path prefix for flux assets.
     */
    public function getAssetPrefix(): ?string
    {
        if ($prefix = Str::trim(config('livewire-tweak.flux.prefix.assets')))
        {
            return Str::start(Str::finish($prefix, '/'), '/');
        }

        return null;
    }

    /**
     * Load and render the scripts view.
     */
    public function getAssetView(): string
    {
        return view()->file(__DIR__.'/resources/views/assets/scripts.blade.php')->render();
    }
}
