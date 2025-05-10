<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class CoreRoutes extends BaseRoutes
{
    protected $constantPrefix = CorePrefix::class;

    protected $originalPrefix = 'livewire';

    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ];

    protected $variablePrefix = '{routeswire}';

    protected function applyRoutesPackageAdd(): void
    {
        return;

        Livewire::setUpdateRoute(function ($handle)
        {
            if ($subfolder = parse_url(url('/'), PHP_URL_PATH))
            {
                // return Route::post($subfolder.$this->getPackagesPrefix().'update', $handle);
            }

            return Route::getRoutes()->getByName('livewire.update');
        });
    }
}
