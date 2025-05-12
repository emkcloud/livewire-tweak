<?php

describe('Flux standard routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('fluxStandardRoutes')->done();
});
