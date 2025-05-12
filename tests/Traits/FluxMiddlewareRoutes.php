<?php

namespace Tests\Traits;

trait FluxMiddlewareRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.flux.prefix.enable', true);
        $app['config']->set('livewire-tweak.flux.prefix.groups', 'admin');
        $app['config']->set('livewire-tweak.flux.prefix.domain', false);
        $app['config']->set('livewire-tweak.flux.prefix.middle', '*,auth,web');
    }
}
