<?php

uses(Tests\Traits\FluxStaticBaseRoutes::class);

describe('Flux static routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('fluxStaticBaseRoutes')->done();
});
