<?php

namespace Tests\Traits;

trait FluxStaticBaseRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.flux.prefix.enable', true);
        $app['config']->set('livewire-tweak.flux.prefix.groups', 'admin');
    }
}
