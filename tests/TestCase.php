<?php

namespace Tests;

use Emkcloud\LivewireTweak\Providers\LivewireTweakServiceProvider;
use Flux\FluxServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * @method void customConfigValues(\Illuminate\Contracts\Foundation\Application $app)
 */
class TestCase extends OrchestraTestCase
{
    protected $loadEnvironmentVariables = false;

    protected function defineEnvironment($app)
    {
        if (method_exists($this, 'customConfigValues'))
        {
            $this->customConfigValues($app);
        }
    }

    protected function getPackageProviders($app)
    {
        return
        [
            FluxServiceProvider::class,
            LivewireServiceProvider::class,
            LivewireTweakServiceProvider::class,
        ];
    }

    protected function getRoutes(): \Illuminate\Routing\RouteCollection
    {
        return app('router')->getRoutes();
    }

    protected function getRoutesUri(): \Illuminate\Support\Collection
    {
        return collect($this->getRoutes())->pluck('uri');
    }
}
