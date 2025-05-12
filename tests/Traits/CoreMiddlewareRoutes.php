<?php

namespace Tests\Traits;

trait CoreMiddlewareRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.core.prefix.enable', true);
        $app['config']->set('livewire-tweak.core.prefix.groups', 'admin');

        $app['config']->set('livewire-tweak.core.middleware.enable', true);
        $app['config']->set('livewire-tweak.core.middleware.assign', 'api,auth');
        $app['config']->set('livewire-tweak.core.middleware.assets', true);
        $app['config']->set('livewire-tweak.core.middleware.routes', true);
    }
}
