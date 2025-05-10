<?php

describe('Flux standard routes', function ()
{
    test('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('fluxRoutes')->done();
});
