<?php

namespace Tests\Traits;

trait CoreDynamicPathAssets
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.core.prefix.enable', true);
        $app['config']->set('livewire-tweak.core.prefix.groups', 'admin,backend,customers');
        $app['config']->set('livewire-tweak.core.prefix.assets', 'custom/path');
        $app['config']->set('livewire-tweak.core.prefix.domain', false);
    }
}
