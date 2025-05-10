<?php

namespace Tests;

use Emkcloud\LivewireTweak\Providers\LivewireTweakServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Livewire\LivewireServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected bool $fluxServiceAvailable = false;

    protected function getEnvironmentSetUp($app)
    {
    }

    protected function getPackageProviders($app)
    {
        dd('provide');
        return
        [
            LivewireServiceProvider::class,
            LivewireTweakServiceProvider::class,
        ];        
    }

    protected function setUp(): void
    {
        if ($this->app->providerIsLoaded(\App\Providers\MyServiceProvider::class);

        dd('setup');

        parent::setUp();

        $this->serviceAvailable = class_exists(\App\Services\MyService::class) &&
        $this->app->providerIsLoaded(\App\Providers\MyServiceProvider::class);
    }
}
