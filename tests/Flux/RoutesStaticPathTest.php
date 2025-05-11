<?php

uses(Tests\Traits\FluxStaticPathRoutes::class);

describe('Flux static path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('fluxStaticPathRoutes')->done();
});
