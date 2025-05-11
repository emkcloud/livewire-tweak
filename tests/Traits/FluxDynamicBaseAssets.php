<?php

namespace Tests\Traits;

trait FluxDynamicBaseAssets
{
    protected function customConfigValues($app)
    {
        $app['config']->set('livewire-tweak.flux.prefix.enable', true);
        $app['config']->set('livewire-tweak.flux.prefix.groups', 'admin,backend,customers');
        $app['config']->set('livewire-tweak.flux.prefix.domain', false);
    }
}
