<?php

namespace Emkcloud\LivewireTweak\Core;

use Composer\InstalledVersions;
use Emkcloud\LivewireTweak\Base\BaseRoutes;
use Illuminate\Support\Str;
use Livewire\Mechanisms\HandleRequests\EndpointResolver;

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

    protected function getConfigPrefixRoutes(): ?string
    {
        if (version_compare($this->getVersionLivewire(), '4.2.0', '>='))
        {
            return null;
        }

        return parent::getConfigPrefixRoutes();
    }

    protected function startVariables(): void
    {
        if (version_compare($this->getVersionLivewire(), '4.2.0', '>='))
        {
            $this->prefixOriginal = EndpointResolver::prefix();

            $this->packageRoutes = [
                Str::trim(EndpointResolver::updatePath(),'/') => 'route',
                Str::trim(EndpointResolver::scriptPath(true),'/') => 'asset',
                Str::trim(EndpointResolver::scriptPath(false),'/') => 'asset',
                Str::trim(EndpointResolver::mapPath(true),'/') => 'asset',
                Str::trim(EndpointResolver::mapPath(false),'/') => 'asset',
                Str::trim(EndpointResolver::uploadPath(),'/') => 'action',
                Str::trim(EndpointResolver::previewPath(),'/') => 'action',
                Str::trim(EndpointResolver::componentJsPath(),'/') => 'asset',
                Str::trim(EndpointResolver::componentCssPath(),'/') => 'asset',
                Str::trim(EndpointResolver::componentGlobalCssPath(),'/') => 'asset',
            ];
        }
    }
}
