<?php

uses(Tests\Traits\FluxDynamicBaseRoutes::class);

describe('Flux dynamic base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('fluxDynamicBaseRoutes')->done();
});
