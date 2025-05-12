<?php

uses(Tests\Traits\CoreStaticBaseRoutes::class);

describe('Livewire static base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('coreStaticBaseRoutes')->done();
});
