<?php

uses(Tests\Traits\CoreDynamicBaseAssets::class);

describe('Livewire dynamic base assets', function ()
{
    it('should contain <script> tag', function ()
    {
        $output = view('livewire-tweak::core.assets.scripts')->render();

        expect($output)->toBeString()->toContain('<script');

    })->done();

    it('should contain <script> uri', function ()
    {
        $output = view('livewire-tweak::core.assets.scripts')->render();

        expect($output)->toBeString()->toContain('src="/admin/livewire/livewire.min.js');

    })->done();

    it('should contain <script> data-update-uri', function ()
    {
        $output = view('livewire-tweak::core.assets.scripts')->render();

        expect($output)->toBeString()->toContain('data-update-uri="/admin/livewire/update"');

    })->done();
});
