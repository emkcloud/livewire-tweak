<?php

uses(Tests\Traits\CoreStaticPathRoutes::class);

describe('Livewire static path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('coreStaticPathRoutes')->done();
});
