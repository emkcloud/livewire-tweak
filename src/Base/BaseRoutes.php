<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BaseRoutes extends BaseCommon
{
    protected $datasetsRoutes = [];

    protected $originalRoutes = [];

    public function start(): void
    {
        $this->startRoutesPrefix();
        $this->startRoutesPrefixAddon();
    }

    protected function startRoutesPrefix(): void
    {
        $this->setRoutesDatasets();

        if ($this->isAllowedToChangeRoutes())
        {
            $this->applyRoutesRemove();
            $this->applyRoutesRemoveAdd();

            $this->applyRoutesPackage();
            $this->applyRoutesPackageAdd();
        }
    }

    protected function startRoutesPrefixAddon(): void {}

    protected function checkOriginalRoute($route): bool
    {
        return in_array($route->uri(), $this->getOriginalRoutes());
    }

    protected function isAllowedToChangeRoutes(): bool
    {
        return $this->checkPrefixEnable() && $this->checkPrefixGroups();
    }

    protected function getOriginalRoutes(): array
    {
        return $this->originalRoutes;
    }

    protected function getRoutesDatasets(): array
    {
        return $this->datasetsRoutes;
    }

    protected function setRoutesDatasets(): void
    {
        $this->datasetsRoutes = collect(Route::getRoutes())->filter(function ($route)
        {
            return $this->checkOriginalRoute($route);

        })->all();
    }

    protected function applyRoutesPackage(): void
    {
        $this->checkPrefixGroupsSingle()
            ? $this->applyRoutesPackageSingle()
            : $this->applyRoutesPackageMultiple();
    }

    protected function applyRoutesPackageSingle(): void
    {
        foreach ($this->getRoutesDatasets() as $route)
        {
            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getPrefixGroupsMain()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            app('router')->addRoute($route->methods(), $routeUri, $route->getAction());
        }
    }

    protected function applyRoutesPackageMultiple(): void
    {
        foreach ($this->getRoutesDatasets() as $route)
        {
            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getVariablePrefix()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            $newRoute = app('router')->addRoute($route->methods(), $routeUri, $route->getAction());

            $newRoute->where($this->getVariablePrefixName(), implode('|', $this->getPrefixGroups()));
        }
    }

    protected function applyRoutesPackageAdd(): void {}

    protected function applyRoutesRemove(): void
    {
        $collection = new RouteCollection;

        foreach (app('router')->getRoutes() as $route)
        {
            if (! $this->checkOriginalRoute($route))
            {
                $collection->add($route);
            }
        }

        app('router')->setRoutes($collection);
    }

    protected function applyRoutesRemoveAdd(): void {}
}
