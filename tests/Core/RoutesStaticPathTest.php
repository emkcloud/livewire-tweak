<?php

uses(Tests\Traits\CoreStaticPathRoutes::class);

describe('Livewire path path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('coreStaticPathRoutes')->done();
});
