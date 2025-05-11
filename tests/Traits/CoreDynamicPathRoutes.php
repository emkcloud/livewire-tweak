<?php

namespace Tests\Traits;

trait CoreDynamicPathRoutes
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.core.prefix.enable', true);
        $app['config']->set('livewire-tweak.core.prefix.groups', 'admin,backend,customers');
        $app['config']->set('livewire-tweak.core.prefix.routes', 'custom/path');
    }
}
