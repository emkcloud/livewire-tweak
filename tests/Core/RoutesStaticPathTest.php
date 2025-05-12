<?php

uses(Tests\Traits\CoreStaticPathRoutes::class);

describe('Livewire static path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('coreStaticPathRoutes')->done();
});
