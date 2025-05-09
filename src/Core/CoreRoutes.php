<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class CoreRoutes extends BaseRoutes
{
    protected $constantPrefix = CorePrefix::class;

    protected $variablePrefix = '{routeswire}';
}
