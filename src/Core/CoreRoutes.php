<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseConfig;
use Emkcloud\LivewireTweak\Base\BaseRoutes;

class CoreRoutes extends BaseRoutes
{
    protected $originalPrefix = 'livewire';

    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ];

    public function checkRoutesPrefix(): bool
    {
        return BaseConfig::value(CorePrefix::ENABLE) == true;
    }

    public function checkRoutesRemove(): bool
    {
        return BaseConfig::value(CorePrefix::REMOVE) == true;
    }

    public function getRoutesPrefix(): ?string
    {
        return BaseConfig::prefix(CorePrefix::ROUTES);
    }
}
