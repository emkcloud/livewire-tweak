<?php

namespace Emkcloud\LivewireTweak\Flux;

use Illuminate\Support\Str;

class FluxManager
{
    public function appearance()
    {
        return $this->getAppearanceView();
    }

    public function scripts()
    {
        $prefix = $this->getAssetPrefix();
        $output = $this->getAssetView();

        if ($prefix)
        {
            $output = str_replace('src="/flux/', sprintf('src="%s',$prefix), $output);
        }

        return $output;
    }

    public function getAppearanceView()
    {
        return view()->file(__DIR__.'/resources/views/appearance.blade.php')->render();
    }

    public function getAssetPrefix()
    {
        return Str::start(Str::finish(config('livewire-tweak.flux.prefix.assets'), '/'), '/');
    }

    public function getAssetView()
    {
        return view()->file(__DIR__.'/resources/views/scripts.blade.php')->render();
    }
}
