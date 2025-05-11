<?php

describe('Livewire configuration options', function ()
{
    it('should return the value core.prefix.enable', function ()
    {
        $option = config('livewire-tweak.core.prefix.enable');

        expect($option)->toBeBool()->toBe(false);

    })->done();

    it('should return the value core.prefix.groups', function ()
    {
        $option = config('livewire-tweak.core.prefix.groups');

        expect($option)->toBeFalsy();

    })->done();

    it('should return the value core.prefix.assets', function ()
    {
        $option = config('livewire-tweak.core.prefix.assets');

        expect($option)->toBe('livewire');

    })->done();

    it('should return the value core.prefix.routes', function ()
    {
        $option = config('livewire-tweak.core.prefix.routes');

        expect($option)->toBe('livewire');

    })->done();

    it('should return the value core.prefix.domain', function ()
    {
        $option = config('livewire-tweak.core.prefix.domain');

        expect($option)->toBeBool()->toBe(true);

    })->done();
});
