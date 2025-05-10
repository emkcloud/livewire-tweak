<?php

namespace Tests;

use Emkcloud\LivewireTweak\Providers\LivewireTweakServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Livewire\LivewireServiceProvider;
use Flux\FluxServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected bool $fluxServiceAvailable = false;

    protected function getEnvironmentSetUp($app)
    {
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

    protected function getRoutes(): \Illuminate\Support\Collection
    {
        return collect(app('router')->getRoutes())->pluck('uri');
    }
}
