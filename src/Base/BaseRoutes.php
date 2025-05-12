<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Str;

class BaseRoutes extends BaseCommon
{
    protected $datasets = [];

    protected $packageRoutes = [];

    protected $registered = [];

    public function start(): void
    {
        $this->startDatasets();
        $this->startPrefix();
        $this->startMiddleware();
    }

    protected function startDatasets(): void
    {
        foreach ($this->getRoutes() as $route)
        {
            if ($scope = $this->getPackageRoutes()[$route->uri] ?? null)
            {
                $this->datasets[] = ['route' => $route, 'scope' => $scope];
            }
        }
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

    protected function AddToRegistered($route, $scope): void
    {
        $this->registered[] = ['route' => $route, 'scope' => $scope];
    }

    protected function applyPrefix(): void
    {
        $this->checkPrefixGroupsSingle()
            ? $this->applyPrefixSingle()
            : $this->applyPrefixMultiple();
    }

    protected function applyPrefixSingle(): void
    {
        foreach ($this->getDatasets() as $value)
        {
            $route = $value['route'];

            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getPrefixGroupsMain()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            $newRoute = app('router')->addRoute($route->methods(), $routeUri, $route->getAction());

            $this->AddToRegistered($newRoute, $value['scope']);
        }
    }

    protected function applyPrefixMultiple(): void
    {
        foreach ($this->getDatasets() as $value)
        {
            $route = $value['route'];

            $routeUri = $this->getTrimPath(
                Str::replaceStart($this->getPrefixOriginal(), '', $route->uri()));

            $routeUri =
                $this->finishSlash($this->getPrefixVariable()).
                $this->finishEmpty($this->getPrefixRoutes()).$routeUri;

            $newRoute = app('router')->addRoute($route->methods(), $routeUri, $route->getAction());

            $newRoute->where($this->getPrefixVariableName(), implode('|', $this->getPrefixGroups()));

            $this->AddToRegistered($newRoute, $value['scope']);
        }
    }

    protected function applyMiddleware(): void
    {
        foreach ($this->getRegistered() as $route)
        {
            $this->applyMiddlewareRemove($route);
            $this->applyMiddlewareAssign($route);
        }
    }

    protected function applyMiddlewareAssign($route): void
    {
        $class = $route['route'];
        $scope = $route['scope'];

        foreach ($this->getMiddlewareForAssign() as $middleware)
        {
            if (! in_array($middleware, $class->action['middleware'] ?? []))
            {
                $enableMiddleware = false;

                if ($scope == 'asset' && $this->checkMiddlewareAssets())
                {
                    $enableMiddleware = true;
                }

                if ($scope == 'route' && $this->checkMiddlewareRoutes())
                {
                    $enableMiddleware = true;
                }

                if ($enableMiddleware)
                {
                    $class->action['middleware'][] = $middleware;
                }
            }
        }
    }

    protected function applyMiddlewareRemove($route): void
    {
        if ($this->checkMiddlewareRemove())
        {
            $route['route']->action['middleware'] = [];
        }
    }

    protected function applyRemove(): void
    {
        $collection = new RouteCollection;

        foreach ($this->getRoutes() as $route)
        {
            if (! $this->checkPackageRoute($route))
            {
                $collection->add($route);
            }
        }

        app('router')->setRoutes($collection);
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

    protected function getMiddlewareForAssign(): array
    {
        /** @var Illuminate\Contracts\Http\Kernel $kernel */
        $kernel = app()->make(Kernel::class);

        $middlewareUpdate = [];
        $middlewareRoutes = $kernel->getRouteMiddleware();
        $middlewareGroups = $kernel->getMiddlewareGroups();

        foreach ($this->getMiddlewareAssign() as $middleware)
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

        return $middlewareUpdate;
    }

    protected function getRegistered(): array
    {
        return $this->registered;
    }

    protected function getRoutes(): RouteCollection
    {
        return app('router')->getRoutes();
    }

    protected function isAllowedToChangePrefix(): bool
    {
        return $this->checkPrefixEnable() && $this->checkPrefixGroups();
    }

    protected function isAllowedToChangeMiddleware(): bool
    {
        return $this->checkMiddlewareEnable() && $this->checkMiddlewareAssign();
    }
}
