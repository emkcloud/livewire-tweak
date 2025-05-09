<?php

namespace Emkcloud\LivewireTweak\Flux;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class FluxRoutes extends BaseRoutes
{
    protected $constantCustom = FluxCustom::class;

    protected $constantPrefix = FluxPrefix::class;

    protected $originalPrefix = 'flux';

    protected $originalRoutes = [
        'flux/flux.js',
        'flux/flux.min.js',
        'flux/editor.css',
        'flux/editor.js',
        'flux/editor.min.js',
    ];

    protected $variablePrefix = '{customflux}';
}
