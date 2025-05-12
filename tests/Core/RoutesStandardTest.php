<?php

describe('Livewire standard routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('coreStandardRoutes')->done();
});
