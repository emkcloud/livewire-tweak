<?php

describe('Flux views', function ()
{
    it('should generate the view assets.enable', function ()
    {
        $output = view('livewire-tweak::flux.assets.appearance')->render();

        expect($output)->toBeString()->toContain('window.Flux.applyAppearance');

    })->done();

    it('should generate the view assets.scripts', function ()
    {
        $output = view('livewire-tweak::flux.assets.scripts')->render();

        expect($output)->toBeString()->toContain('<script src=');

    })->done();
});
