<?php

namespace Tests\Traits;

trait CoreStaticPathAssets
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.core.prefix.enable', true);
        $app['config']->set('livewire-tweak.core.prefix.groups', 'admin');
        $app['config']->set('livewire-tweak.core.prefix.assets', 'custom/path');
        $app['config']->set('livewire-tweak.core.prefix.domain', false);
    }
}
