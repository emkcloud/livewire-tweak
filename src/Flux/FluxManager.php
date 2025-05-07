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
     * Generate Blade directive scripts.
     */
    public function scripts(): string
    {
        $prefix = $this->getAssetPrefix();
        $output = $this->getAssetView();

        return ($prefix) ? preg_replace('#src="/flux/#', 'src="'.$prefix, $output) : $output;
    }

    /**
     * Override original Flux editorStyles.
     */
    public function editorStyles()
    {
        $output = app('flux')->editorStyles();
        $prefix = $this->getAssetPrefix();

        return ($prefix) ? preg_replace('#href="/flux/#', 'href="'.$prefix, $output) : $output;
    }

    /**
     * Override original Flux editorScripts.
     */
    public function editorScripts()
    {
        $output = app('flux')->editorScripts();
        $prefix = $this->getAssetPrefix();

        return ($prefix) ? preg_replace('#src="/flux/#', 'src="'.$prefix, $output) : $output;
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
