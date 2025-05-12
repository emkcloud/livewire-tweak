<?php

namespace Tests\Traits;

trait FluxMiddlewareRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.flux.prefix.enable', true);
        $app['config']->set('livewire-tweak.flux.prefix.groups', 'admin');

        $app['config']->set('livewire-tweak.flux.middleware.enable', true);
        $app['config']->set('livewire-tweak.flux.middleware.assign', 'api,auth');
        $app['config']->set('livewire-tweak.flux.middleware.assets', true);
        $app['config']->set('livewire-tweak.flux.middleware.routes', true);
    }
}
