<?php

uses(Tests\Traits\FluxMiddlewareRoutes::class);

describe('Flux middleware routes', function ()
{
    it('should contain middleware', function (string $uri)
    {
        $middleware = [];

        foreach ($this->getRoutes() as $route)
        {
            if ($route->uri == $uri)
            {
                $middleware = $route->middleware();
            }
        }

        expect($middleware)->toContain('api', 'auth');

    })->with('fluxMiddlewareRoutes')->done();
});
