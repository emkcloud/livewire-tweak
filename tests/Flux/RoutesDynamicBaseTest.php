<?php

uses(Tests\Traits\FluxDynamicBaseRoutes::class);

describe('Flux dynamic routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('fluxDynamicBaseRoutes')->done();
});
