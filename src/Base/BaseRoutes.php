<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BaseRoutes
{
    protected $datasetsRoutes;

    protected $packagesPrefix;

    protected $originalPrefix;

    protected $originalRoutes = [];

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

    public function checkRoutesPrefix(): bool
    {
        return false;
    }

    public function checkRoutesRemove(): bool
    {
        return false;
    }

    public function getPackagesPrefix(): ?string
    {
        return $this->packagesPrefix;
    }

    public function getRoutesDatasets(): array
    {
        return $this->datasetsRoutes;
    }

    public function getRoutesPrefix(): ?string
    {
        return null;
    }

    public function setRoutesDatasets(): void
    {
        $this->datasetsRoutes = collect(Route::getRoutes())->filter(function ($route)
        {
            return in_array($route->uri(), $this->originalRoutes);

        })->all();
    }

    public function setRoutesPrefix(): void
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

    public function setRoutesPackage(): void
    {
        if ($this->getPackagesPrefix())
        {
            $this->applyRoutesPackage();
        }
    }

    public function setRoutesRemove(): void
    {
        if ($this->getPackagesPrefix())
        {
            $this->applyRoutesRemove();
        }
    }

    public function applyRoutesPackage(): void
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

    public function applyRoutesRemove(): void
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
}
