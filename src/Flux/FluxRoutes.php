<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class FluxRoutes extends BaseRoutes
{
    protected $originalRoutes = [
        'flux/flux.js',
        'flux/flux.min.js',
        'flux/editor.css',
        'flux/editor.js',
        'flux/editor.min.js',
    ];

    protected $prefixConstant = FluxPrefix::class;

    protected $prefixOriginal = 'flux';

    protected $prefixVariable = '{routesflux}';

    protected $middlewareConstant = FluxMiddleware::class;
}
