<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseConfig;
use Emkcloud\LivewireTweak\Base\BaseRoutes;

class FluxRoutes extends BaseRoutes
{
    protected $originalPrefix = 'flux';

    protected $originalRoutes = [
        'flux/flux.js',
        'flux/flux.min.js',
        'flux/editor.css',
        'flux/editor.js',
        'flux/editor.min.js',
    ];

    public function checkRoutesPrefix(): bool
    {
        return BaseConfig::value(FluxPrefix::ENABLE) == true;
    }

    public function checkRoutesRemove(): bool
    {
        return BaseConfig::value(FluxPrefix::REMOVE) == true;
    }

    public function getRoutesPrefix(): ?string
    {
        return BaseConfig::prefix(FluxPrefix::ROUTES);
    }
}
