<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseRoutes;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class CoreRoutes extends BaseRoutes
{
    protected $constantCustom = CoreCustom::class;

    protected $constantPrefix = CorePrefix::class;

    protected $originalPrefix = 'livewire';

    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ];

    protected function applyRoutesPackageAdd(): void
    {
        $updatepath = parse_url(url('/'), PHP_URL_PATH).$this->getPackagesPrefix();

        Livewire::setUpdateRoute(function ($handle) use ($updatepath)
        {
            return Route::post($updatepath.'update', $handle);
        });
    }
}
