<?php

describe('Flux views', function ()
{
    it('should generate the view assets.enable', function ()
    {
        $output = view('livewire-tweak::flux.assets.appearance')->render();
dd($output);
        expect(true)->toBe(true);

    })->done();

    it('should generate the view assets.scripts', function ()
    {
        view('livewire-tweak::flux.assets.scripts');

        expect(true)->toBe(true);

    })->done();

    it('should generate the view overrides.scripts', function ()
    {
        view('livewire-tweak::flux.overrides.editor.scripts');

        expect(true)->toBe(true);

    })->done();

    it('should generate the view overrides.styles', function ()
    {
        view('livewire-tweak::flux.overrides.editor.styles');

        expect(true)->toBe(true);

    })->done();
});
