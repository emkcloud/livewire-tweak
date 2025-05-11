<?php

uses(Tests\Traits\FluxDynamicBaseAssets::class);

describe('Flux dynamic base assets', function ()
{
    it('should contain <script> tag', function ()
    {
        $output = view('livewire-tweak::flux.directives.scripts')->render();

        expect($output)->toBeString()->toContain('<script');

    })->done();

    it('should contain <script> uri', function ()
    {
        $output = view('livewire-tweak::flux.directives.scripts')->render();

        expect($output)->toBeString()->toContain('src="/admin/flux/flux.min.js');

    })->done();
});
