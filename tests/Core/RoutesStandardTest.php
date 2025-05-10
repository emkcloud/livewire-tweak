<?php

describe('Livewire standard routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('coreStandardRoutes')->done();
});
