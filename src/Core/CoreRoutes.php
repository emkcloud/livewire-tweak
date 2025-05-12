<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class CoreRoutes extends BaseRoutes
{
    protected $packageRoutes = [
        'livewire/livewire.js' => 'asset',
        'livewire/livewire.min.js' => 'asset',
        'livewire/livewire.min.js.map' => 'asset',
        'livewire/preview-file/{filename}' => 'action',
        'livewire/update' => 'route',
        'livewire/upload-file' => 'action',
    ];

    protected $prefixConstant = CorePrefix::class;

    protected $prefixOriginal = 'livewire';

    protected $prefixVariable = '{routeswire}';

    protected $middlewareConstant = CoreMiddleware::class;
}
