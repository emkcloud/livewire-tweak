<?php

namespace Tests\Traits;

trait FluxDynamicPathRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.flux.prefix.enable', true);
        $app['config']->set('livewire-tweak.flux.prefix.groups', 'admin,backend,customers');
        $app['config']->set('livewire-tweak.flux.prefix.routes', 'custom/path');
    }
}
