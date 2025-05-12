<?php

uses(Tests\Traits\CoreMiddlewareRoutes::class);

describe('Livewire middleware routes', function ()
{
    it('should contain middleware auth/web', function ()
    {
        $middleware = [];

        foreach (app('router')->getRoutes() as $route)
        {
            if ($route->uri == 'admin/livewire/livewire.min.js')
            {
                $middleware = $route->middleware();
            }
        }

        expect($middleware)->toContain('auth', 'web');

    })->done();
});
