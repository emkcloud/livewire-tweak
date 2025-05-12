<?php

uses(Tests\Traits\CoreDynamicBaseRoutes::class);

describe('Livewire dynamic base routes', function ()
{
    it('should contain uri', function (string $uri)
    {
        expect($this->getRoutesUri())->toContain($uri);

    })->with('coreDynamicBaseRoutes')->done();
});
