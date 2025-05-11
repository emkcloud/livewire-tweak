<?php

uses(Tests\Traits\FluxDynamicPathAssets::class);

describe('Flux dynamic path assets', function ()
{
    it('should contain <script> tag', function ()
    {
        $output = view('livewire-tweak::flux.directives.scripts')->render();

        expect($output)->toBeString()->toContain('<script');

    })->done();

    it('should contain <script> uri', function ()
    {
        $output = view('livewire-tweak::flux.directives.scripts')->render();

        expect($output)->toBeString()->toContain('src="/admin/custom/path/flux.min.js');

    })->done();
});
