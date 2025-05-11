<?php

uses(Tests\Traits\CoreDynamicBaseRoutes::class);

describe('Livewire dynamic base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutes())->toContain($uri);

    })->with('coreDynamicBaseRoutes')->done();
});
