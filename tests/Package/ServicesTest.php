<?php

use Emkcloud\LivewireTweak\Providers\LivewireTweakServiceProvider;
use Livewire\LivewireServiceProvider;
use Flux\FluxServiceProvider;

describe('Package', function ()
{
    it('should load the service provider flux', function ()
    {
        expect(app()->getLoadedProviders())
            ->toHaveKey(FluxServiceProvider::class);

    })->done();

    it('should load the service provider livewire', function ()
    {
        expect(app()->getLoadedProviders())
            ->toHaveKey(LivewireServiceProvider::class);

    })->done();

    it('should load the service provider livewire-tweak', function ()
    {
        expect(app()->getLoadedProviders())
            ->toHaveKey(LivewireTweakServiceProvider::class);

    })->done();
});
