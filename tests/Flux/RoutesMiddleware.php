<?php

uses(Tests\Traits\FluxMiddlewareRoutes::class);

describe('Flux middleware routes', function ()
{
    it('should contain middleware auth/web', function ()
    {
        $middleware = [];

        foreach (app('router')->getRoutes() as $route)
        {
            if ($route->uri == 'admin/flux/flux.min.js')
            {
                $middleware = $route->middleware();
            }
        }

        expect($middleware)->toContain('auth', 'web');

    })->done();
});
