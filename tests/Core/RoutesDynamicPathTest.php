<?php

uses(Tests\Traits\CoreDynamicPathRoutes::class);

describe('Livewire dynamic path routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('coreDynamicPathRoutes')->done();
});
