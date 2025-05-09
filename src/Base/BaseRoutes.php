<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class BaseRoutes
{
    protected $constantCustom;

    protected $constantPrefix;

    protected $datasetsRoutes;

    protected $defaultsPrefix = [];

    protected $originalPrefix;

    protected $originalRoutes = [];

    protected $packagesPrefix;

    protected $variablePrefix;

    public function __construct()
    {
        $this->packagesPrefix = $this->getPrefixRoutes();
        $this->defaultsPrefix = $this->getCustomPrefix();
    }

    public function start(): void
    {
        if (! App::routesAreCached())
        {
            $this->setRoutesDatasets();
            $this->setRoutesPrefix();
        }
    }

    protected function checkCustomEnable(): bool
    {
        return $this->getCustomEnable() == true;
    }

    protected function checkPrefixEnable(): bool
    {
        return $this->getPrefixEnable() == true;
    }

    protected function getCustomEnable()
    {
        if (class_exists($this->constantCustom))
        {
            return BaseConfig::prefix($this->constantCustom::ENABLE);
        }
    }

    protected function getCustomPrefix(): array
    {
        $defaulsPrefix = [];

        if (class_exists($this->constantCustom))
        {
            foreach (explode(',',BaseConfig::value($this->constantCustom::PREFIX)) as $value)
            {
                $defaulsPrefix[] = Str::trim(Str::trim($value),'/');
            }
        }

        return $defaulsPrefix;
    }

    protected function getCustomRoutes()
    {
        if (class_exists($this->constantCustom))
        {
            return BaseConfig::prefix($this->constantCustom::ROUTES);
        }
    }

    protected function getPrefixEnable()
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::prefix($this->constantPrefix::ENABLE);
        }
    }

    protected function getPrefixRoutes()
    {
        if (class_exists($this->constantPrefix))
        {
            return BaseConfig::prefix($this->constantPrefix::ROUTES);
        }
    }

    protected function getDefaultsPrefix(): array
    {
        return $this->defaultsPrefix;
    }

    protected function getOriginalPrefix(): ?string
    {
        return $this->originalPrefix;
    }

    protected function getPackagesPrefix(): ?string
    {
        return $this->packagesPrefix;
    }

    protected function getRoutesDatasets(): array
    {
        return $this->datasetsRoutes;
    }

    protected function getVariablePrefix(): ?string
    {
        return $this->variablePrefix;
    }

    protected function isAllowedToChangeRoute(): bool
    {
        return $this->checkCustomEnable() or $this->checkPrefixEnable();
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
        if ($this->isAllowedToChangeRoute())
        {
            $this->applyRoutesPackage();
            $this->applyRoutesPackageAdd();

            $this->applyRoutesRemove();
            $this->applyRoutesRemoveAdd();
        }
    }

    protected function applyRoutesPackage(): void
    {
        if ($this->checkPrefixEnable() && $this->getPackagesPrefix())
        {
            $this->applyRoutesPackagePrefix();
        }

        if ($this->checkCustomEnable() && $this->getVariablePrefix())
        {
            if (count($this->getDefaultsPrefix()) > 0)
            {
                $this->applyRoutesPackageCustom();
            }
        }
    }

    protected function applyRoutesPackageAdd(): void {}

    protected function applyRoutesPackageCustom(): void
    {
        $this->applyRoutesPackageCustomDefault();
        $this->applyRoutesPackageCustomRoutes();
    }

    protected function applyRoutesPackageCustomDefault(): void
    {
        $dynamic = Str::trim($this->getVariablePrefix(),'{}');
        $default = Str::trim($this->getDefaultsPrefix()[0]);

        URL::defaults([$dynamic => $default]);
    }

    protected function applyRoutesPackageCustomRoutes(): void
    {
        $dynamic = Str::trim($this->getVariablePrefix(),'{}');

        foreach ($this->getRoutesDatasets() as $route)
        {
            $routeUri = Str::replaceStart($this->getOriginalPrefix(), '', $route->uri());
            $routeUri = Str::trim($routeUri, '/');

            $routeUri = (!$this->getCustomRoutes())
                ? $routeUri = $this->getVariablePrefix().'/'.$routeUri
                : $routeUri = $this->getVariablePrefix().$this->getCustomRoutes().$routeUri;

            $newRoute = app(Router::class)->addRoute($route->methods(),$routeUri,$route->getAction());

            $newRoute->where($dynamic, implode('|',$this->getDefaultsPrefix()));
        }
    }

    protected function applyRoutesPackagePrefix(): void
    {
        foreach ($this->getRoutesDatasets() as $route)
        {
            $routeUri = Str::replaceStart($this->getOriginalPrefix(), '', $route->uri());
            $routeUri = Str::trim($this->getPackagesPrefix(), '/').$routeUri;

            app(Router::class)->addRoute($route->methods(),$routeUri,$route->getAction());
        }
    }

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
