<?php

uses(Tests\Traits\FluxMiddlewareRoutes::class);

describe('Flux middleware routes', function ()
{
    it('should contain uri', function ()
    {
        dd(app('router')->getRoutes());
        //expect($this->getRoutes())->toContain($uri);

    })->done();
});
