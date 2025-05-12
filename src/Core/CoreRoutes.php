<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;

class CoreRoutes extends BaseRoutes
{
    protected $constantPrefix = CorePrefix::class;

    protected $originalPrefix = 'livewire';

    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ]; 

    protected $variablePrefix = '{routeswire}';
}
