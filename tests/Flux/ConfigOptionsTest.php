<?php

describe('Flux configuration options', function ()
{
    it('should return the value flux.prefix.enable', function ()
    {
        $option = config('livewire-tweak.flux.prefix.enable');

        expect($option)->toBeBool()->toBe(false);

    })->done();

    it('should return the value flux.prefix.groups', function ()
    {
        $option = config('livewire-tweak.flux.prefix.groups');

        expect($option)->toBeFalsy();

    })->done();

    it('should return the value flux.prefix.assets', function ()
    {
        $option = config('livewire-tweak.flux.prefix.assets');

        expect($option)->toBe('flux');

    })->done();

    it('should return the value flux.prefix.routes', function ()
    {
        $option = config('livewire-tweak.flux.prefix.routes');

        expect($option)->toBe('flux');

    })->done();

    it('should return the value flux.prefix.domain', function ()
    {
        $option = config('livewire-tweak.flux.prefix.domain');

        expect($option)->toBeBool()->toBe(true);

    })->done();
});
