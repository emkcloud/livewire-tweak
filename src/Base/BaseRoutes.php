<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class BaseRoutes extends BaseCommon
{
    protected $datasets = [];

    protected $packageRoutes = [];

    public function start(): void
    {
        $this->startDatasets();
        $this->startPrefix();
        $this->startMiddleware();
    }

    protected function startDatasets(): void
    {
        $this->datasets = collect(Route::getRoutes())->filter(function ($route)
        {
            return $this->checkPackageRoute($route);

        })->all();
    }

    protected function startPrefix(): void
    {
        if ($this->isAllowedToChangePrefix())
        {
            $this->applyRemove();
            $this->applyPrefix();
        }
    }

    protected function startMiddleware(): void
    {
        if ($this->isAllowedToChangeMiddleware())
        {
            $this->applyMiddleware();
        }
    }

    protected function checkPackageRoute($route): bool
    {
        return in_array($route->uri(), $this->getPackageRoutesUri());
    }

    protected function getDatasets(): array
    {
        return $this->datasets;
    }

    protected function getPackageRoutes(): array
    {
        return $this->packageRoutes;
    }

    protected function getPackageRoutesUri(): array
    {
        return array_keys($this->packageRoutes);
    }

    protected function isAllowedToChangePrefix(): bool
    {
        return $this->checkPrefixEnable() && $this->checkPrefixGroups();
    }

    protected function isAllowedToChangeMiddleware(): bool
    {
        return $this->checkMiddlewareEnable() && $this->checkMiddlewareAssign();
    }

    protected function applyPrefix(): void
    {
        $this->checkPrefixGroupsSingle()
            ? $this->applyPrefixSingle()
            : $this->applyPrefixMultiple();
    }

    protected function applyPrefixSingle(): void
    {
        foreach ($this->getDatasets() as $route)
        {
            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getPrefixGroupsMain()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            app('router')->addRoute($route->methods(), $routeUri, $route->getAction());
        }
    }

    protected function applyPrefixMultiple(): void
    {
        foreach ($this->getDatasets() as $route)
        {
            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getPrefixVariable()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            $newRoute = app('router')->addRoute($route->methods(), $routeUri, $route->getAction());

            $newRoute->where($this->getPrefixVariableName(), implode('|', $this->getPrefixGroups()));
        }
    }

    protected function applyRemove(): void
    {
        $collection = new RouteCollection;

        foreach (app('router')->getRoutes() as $route)
        {
            if (! $this->checkPackageRoute($route))
            {
                $collection->add($route);
            }
        }

        app('router')->setRoutes($collection);
    }

    protected function applyMiddleware(): void
    {
        dd('aaaaaaaaa');
    }
}
