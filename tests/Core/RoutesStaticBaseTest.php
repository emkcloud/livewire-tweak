<?php

uses(Tests\Traits\CoreStaticBaseRoutes::class);

describe('Livewire static base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('coreStaticBaseRoutes')->done();
});
