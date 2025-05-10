<?php

namespace Tests\Traits;

trait CoreStaticBaseRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.core.prefix.enable',true);
        $app['config']->set('livewire-tweak.core.prefix.groups','admin');
    }
}