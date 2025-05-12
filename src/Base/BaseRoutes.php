<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Contracts\Http\Kernel;
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

    protected function isAllowedToChangeMiddleware(): bool
    {
        return $this->isAllowedToChangeRoutes() && $this->checkPrefixMiddleware();
    }

    protected function isAllowedToResetMiddleware(): bool
    {
        return $this->isAllowedToChangeMiddleware() && ! $this->checkPrefixMiddlewareWithPreserve();
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

    protected function getRoutesMiddlewareForUpdate(): array
    {
        /** @var Illuminate\Contracts\Http\Kernel $kernel */
        $kernel = app()->make(Kernel::class);

        $middlewareUpdate = [];
        $middlewareRoutes = $kernel->getRouteMiddleware();
        $middlewareGroups = $kernel->getMiddlewareGroups();

        foreach ($this->getPrefixMiddleware() as $middleware)
        {
            if ($middleware != '*')
            {
                $middlewareSelected = false;

                if (isset($middlewareRoutes[$middleware]))
                {
                    $middlewareSelected = true;
                }

                if (isset($middlewareGroups[$middleware]))
                {
                    $middlewareSelected = true;
                }

                if (class_exists($middleware) && method_exists($middleware, 'handle'))
                {
                    $middlewareSelected = true;
                }

                if ($middlewareSelected && ! isset($middlewareUpdate[$middleware]))
                {
                    $middlewareUpdate[] = $middleware;
                }
            }
        }

        return $middlewareUpdate;
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

            $newRoute = app('router')->addRoute($route->methods(), $routeUri, $route->getAction());

            $this->applyRoutesPackageMiddleware($newRoute);
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

            $this->applyRoutesPackageMiddleware($newRoute);
        }
    }

    protected function applyRoutesPackageMiddleware($route): void
    {
        if ($this->isAllowedToChangeMiddleware())
        {
            $middlewareUpdate = $this->getRoutesMiddlewareForUpdate();

            if ($this->isAllowedToResetMiddleware())
            {
                if (count($middlewareUpdate) > 0)
                {
                    $route->action['middleware'] = [];
                }
            }

            foreach ($middlewareUpdate as $middleware)
            {
                if (! isset($route->action['middleware'][$middleware]))
                {
                    $route->action['middleware'][] = $middleware;
                }
            }
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
