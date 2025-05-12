<?php

uses(Tests\Traits\FluxDynamicPathRoutes::class);

describe('Flux dynamic path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('fluxDynamicPathRoutes')->done();
});
