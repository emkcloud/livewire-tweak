<?php

uses(Tests\Traits\FluxStaticBaseRoutes::class);

describe('Flux static base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('fluxStaticBaseRoutes')->done();
});
