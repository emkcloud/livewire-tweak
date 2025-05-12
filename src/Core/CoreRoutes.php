<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class CoreRoutes extends BaseRoutes
{
    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ];

    protected $prefixConstant = CorePrefix::class;

    protected $prefixOriginal = 'livewire';

    protected $prefixVariable = '{routeswire}';

    protected $middlewareConstant = CoreMiddleware::class;
}
