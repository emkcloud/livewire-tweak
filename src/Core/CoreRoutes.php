<?php

namespace Emkcloud\LivewireTweak\Core;

use Illuminate\Support\Facades\App;

class CoreRoutes
{
    public static function booted()
    {
        if (! App::routesAreCached())
        {
            $instance = new static;
            $instance->registerRoutes();
        }
    }

    public function registerRoutes(): void
    {
        if (config(CorePrefix::ENABLE) == true)
        {
            $this->registerRoutesPrefix();
        }

        if (config(CorePrefix::REMOVE) == true)
        {
            $this->registerRoutesRemove();
        }
    }

    public function registerRoutesPrefix(): void
    {
        if ($prefix = app('livewireTweakCore')->getRoutePrefix())
        {
        }
    }

    public function registerRoutesRemove(): void
    {
    }
}
