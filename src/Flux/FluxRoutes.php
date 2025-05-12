<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class FluxRoutes extends BaseRoutes
{
    protected $packageRoutes = [
        'flux/flux.js' => 'asset',
        'flux/flux.min.js' => 'asset',
        'flux/editor.css' => 'asset',
        'flux/editor.js' => 'asset',
        'flux/editor.min.js' => 'asset',
    ];

    protected $prefixConstant = FluxPrefix::class;

    protected $prefixOriginal = 'flux';

    protected $prefixVariable = '{routesflux}';

    protected $middlewareConstant = FluxMiddleware::class;
}
