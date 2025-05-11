<?php

describe('Flux standard assets', function ()
{
    it('should contain <script> tag', function ()
    {
        $output = view('livewire-tweak::flux.assets.scripts')->render();

        expect($output)->toBeString()->toContain('<script');

    })->done();

    it('should contain <script> uri', function ()
    {
        $output = view('livewire-tweak::flux.assets.scripts')->render();

        expect($output)->toBeString()->toContain('src="/flux/flux.min.js');

    })->done();
});
