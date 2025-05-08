<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BaseRoutes
{
    protected $constantCustom;

    protected $constantPrefix;

    protected $datasetsRoutes;

    protected $originalPrefix;

    protected $originalRoutes = [];

    protected $packagesPrefix;

    public function __construct()
    {
        $this->packagesPrefix = $this->getRoutesPrefix();
    }

    public function start(): void
    {
        if (! App::routesAreCached())
        {
            $this->setRoutesDatasets();
            $this->setRoutesPrefix();
        }
    }

    protected function checkRoutesCustom(): bool
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::value($this->constantPrefix::ENABLE) == true &&
                   BaseConfig::value($this->constantPrefix::CUSTOM) == true;
        }

        return false;
    }

    protected function checkRoutesPrefix(): bool
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::value($this->constantPrefix::ENABLE) == true;
        }

        return false;
    }

    protected function checkRoutesRemove(): bool
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::value($this->constantPrefix::ENABLE) == true &&
                   BaseConfig::value($this->constantPrefix::REMOVE) == true;
        }

        return false;
    }

    protected function getPackagesPrefix(): ?string
    {
        return $this->packagesPrefix;
    }

    protected function getRoutesDatasets(): array
    {
        return $this->datasetsRoutes;
    }

    protected function getRoutesPrefix(): ?string
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::prefix($this->constantPrefix::ROUTES);
        }

        return false;
    }

    protected function setRoutesDatasets(): void
    {
        $this->datasetsRoutes = collect(Route::getRoutes())->filter(function ($route)
        {
            return in_array($route->uri(), $this->originalRoutes);

        })->all();
    }

    protected function setRoutesPrefix(): void
    {
        if ($this->checkRoutesPrefix())
        {
            $this->setRoutesPackage();
        }

        if ($this->checkRoutesRemove())
        {
            $this->setRoutesRemove();
        }
    }

    protected function setRoutesPackage(): void
    {
        if ($this->getPackagesPrefix())
        {
            $this->applyRoutesPackage();
            $this->applyRoutesPackageAdd();
        }
    }

    protected function setRoutesRemove(): void
    {
        if ($this->getPackagesPrefix())
        {
            $this->applyRoutesRemove();
            $this->applyRoutesRemoveAdd();
        }
    }

    protected function applyRoutesPackage(): void
    {
        foreach ($this->getRoutesDatasets() as $route)
        {
            $routeUri = Str::replaceStart($this->originalPrefix, '', $route->uri());
            $routeUri = Str::trim($this->getPackagesPrefix(), '/').$routeUri;

            app(Router::class)->addRoute(
                methods: $route->methods(),
                uri: $routeUri,
                action: $route->getAction()
            );
        }
    }

    protected function applyRoutesPackageAdd(): void {}

    protected function applyRoutesRemove(): void
    {
        $collection = new RouteCollection;

        foreach (Route::getRoutes() as $route)
        {
            if (! in_array($route->uri(), $this->originalRoutes))
            {
                $collection->add($route);
            }
        }

        Route::setRoutes($collection);
    }

    protected function applyRoutesRemoveAdd(): void {}
}
