<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseConfig;
use Emkcloud\LivewireTweak\Base\BaseRoutes;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

class CoreRoutes extends BaseRoutes
{
    protected $originalPrefix = 'livewire';

    protected $originalRoutes = [
        'livewire/livewire.js',
        'livewire/livewire.min.js.map',
        'livewire/preview-file/{filename}',
        'livewire/update',
        'livewire/upload-file',
    ];

    public function checkRoutesPrefix(): bool
    {
        return BaseConfig::value(CorePrefix::ENABLE) == true;
    }

    public function checkRoutesRemove(): bool
    {
        return
            BaseConfig::value(CorePrefix::ENABLE) == true &&
            BaseConfig::value(CorePrefix::REMOVE) == true;
    }

    public function getRoutesPrefix(): ?string
    {
        return BaseConfig::prefix(CorePrefix::ROUTES);
    }

    public function applyRoutesPackageAdd(): void
    {
        $updatepath = parse_url(url('/'), PHP_URL_PATH).$this->getPackagesPrefix();

        Livewire::setUpdateRoute(function ($handle) use($updatepath)
        {
            return Route::post($updatepath.'update', $handle);
        });
    }
}
