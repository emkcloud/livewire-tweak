<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BaseCommon
{
    protected $prefixEnable = false;

    protected $prefixGroups = [];

    protected $prefixAssets = null;

    protected $prefixRoutes = null;

    protected $prefixDomain = false;

    protected $prefixConstant = null;

    protected $prefixOriginal = null;

    protected $prefixVariable = false;

    protected $middlewareEnable = false;

    protected $middlewareAssign = [];

    protected $middlewareAssets = false;

    protected $middlewareRoutes = false;

    protected $middlewareRemove = false;

    protected $middlewareConstant = null;

    public function __construct()
    {
        $this->setConfigPrefixValue();
        $this->setConfigMiddlewareValue();
        $this->setConfigURLDefaultValue();
    }

    public function init() {}

    public function start(): void {}

    protected function checkPrefixEnable(): bool
    {
        return $this->getPrefixEnable();
    }

    protected function checkPrefixGroups(): bool
    {
        return count($this->getPrefixGroups()) > 0;
    }

    protected function checkPrefixGroupsSingle(): bool
    {
        return count($this->getPrefixGroups()) == 1;
    }

    protected function checkPrefixGroupsMultiple(): bool
    {
        return count($this->getPrefixGroups()) > 1;
    }

    protected function checkPrefixAssets(): bool
    {
        return ! empty($this->getPrefixAssets());
    }

    protected function checkPrefixRoutes(): bool
    {
        return ! empty($this->getPrefixRoutes());
    }

    protected function checkPrefixDomain(): bool
    {
        return $this->getPrefixDomain();
    }

    protected function checkMiddlewareEnable(): bool
    {
        return $this->getMiddlewareEnable();
    }

    protected function checkMiddlewareAssign(): bool
    {
        return count($this->getMiddlewareAssign()) > 0;
    }

    protected function checkMiddlewareAssets(): bool
    {
        return $this->getMiddlewareAssets();
    }

    protected function checkMiddlewareRoutes(): bool
    {
        return $this->getMiddlewareRoutes();
    }

    protected function checkMiddlewareRemove(): bool
    {
        return $this->getMiddlewareRemove();
    }

    protected function finishEmpty(?string $value): string
    {
        return $value ? $this->finishSlash($value) : '';
    }

    protected function finishSlash(?string $value): string
    {
        return Str::finish($value, '/');
    }

    protected function getConfigPrefixEnable(): bool
    {
        if (class_exists($this->prefixConstant))
        {
            return filter_var(config($this->prefixConstant::ENABLE), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigPrefixGroups(): array
    {
        if (class_exists($this->prefixConstant))
        {
            if (is_string(config($this->prefixConstant::GROUPS)))
            {
                return array_filter(array_map(function ($item)
                {
                    return Str::trim($item) ? $this->getTrimPath($item) : false;

                }, explode(',', config($this->prefixConstant::GROUPS))));
            }
        }

        return [];
    }

    protected function getConfigPrefixAssets(): ?string
    {
        if (class_exists($this->prefixConstant))
        {
            if (is_string(config($this->prefixConstant::ASSETS)))
            {
                return $this->getTrimPath(config($this->prefixConstant::ASSETS)) ?: null;
            }
        }

        return null;
    }

    protected function getConfigPrefixRoutes(): ?string
    {
        if (class_exists($this->prefixConstant))
        {
            if (is_string(config($this->prefixConstant::ROUTES)))
            {
                return $this->getTrimPath(config($this->prefixConstant::ROUTES)) ?: null;
            }
        }

        return null;
    }

    protected function getConfigPrefixDomain(): bool
    {
        if (class_exists($this->prefixConstant))
        {
            return filter_var(config($this->prefixConstant::DOMAIN), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigMiddlewareEnable(): bool
    {
        if (class_exists($this->middlewareConstant))
        {
            return filter_var(config($this->middlewareConstant::ENABLE), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigMiddlewareAssign(): array
    {
        if (class_exists($this->middlewareConstant))
        {
            if (is_string(config($this->middlewareConstant::ASSIGN)))
            {
                return array_filter(array_map(function ($item)
                {
                    return Str::trim($item) ?: false;

                }, explode(',', config($this->middlewareConstant::ASSIGN))));
            }
        }

        return [];
    }

    protected function getConfigMiddlewareAssets(): bool
    {
        if (class_exists($this->middlewareConstant))
        {
            return filter_var(config($this->middlewareConstant::ASSETS), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigMiddlewareRoutes(): bool
    {
        if (class_exists($this->middlewareConstant))
        {
            return filter_var(config($this->middlewareConstant::ROUTES), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigMiddlewareRemove(): bool
    {
        if (class_exists($this->middlewareConstant))
        {
            return filter_var(config($this->middlewareConstant::REMOVE), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getCurrentPrefixPath(): ?string
    {
        return parse_url(url('/'), PHP_URL_PATH);
    }

    protected function getPrefixEnable(): bool
    {
        return $this->prefixEnable;
    }

    protected function getPrefixGroups(): array
    {
        return $this->prefixGroups;
    }

    protected function getPrefixGroupsMain(): ?string
    {
        return $this->getPrefixGroups()[0] ?? null;
    }

    protected function getPrefixAssets(): ?string
    {
        return $this->prefixAssets;
    }

    protected function getPrefixRoutes(): ?string
    {
        return $this->prefixRoutes;
    }

    protected function getPrefixDomain(): bool
    {
        return $this->prefixDomain;
    }

    protected function getPrefixOriginal(): ?string
    {
        return $this->prefixOriginal;
    }

    protected function getPrefixVariable(): ?string
    {
        return $this->prefixVariable;
    }

    protected function getPrefixVariableName(): ?string
    {
        return Str::trim($this->getPrefixVariable(), '{}');
    }

    protected function getMiddlewareEnable(): bool
    {
        return $this->middlewareEnable;
    }

    protected function getMiddlewareAssign(): array
    {
        return $this->middlewareAssign;
    }

    protected function getMiddlewareAssets(): bool
    {
        return $this->middlewareAssets;
    }

    protected function getMiddlewareRoutes(): bool
    {
        return $this->middlewareRoutes;
    }

    protected function getMiddlewareRemove(): bool
    {
        return $this->middlewareRemove;
    }

    protected function getTrimPath(string $path): string
    {
        return Str::trim(Str::trim($path), '/');
    }

    protected function getURLDefaultParameters(): array
    {
        return app('url')->getDefaultParameters();
    }

    protected function getURLDefaultValue(): string
    {
        if (isset($this->getURLDefaultParameters()[$this->getPrefixVariableName()]))
        {
            return $this->getURLDefaultParameters()[$this->getPrefixVariableName()];
        }

        return $this->getPrefixGroupsMain();
    }

    public function setConfigPrefixValue()
    {
        $this->prefixEnable = $this->getConfigPrefixEnable();
        $this->prefixGroups = $this->getConfigPrefixGroups();
        $this->prefixAssets = $this->getConfigPrefixAssets();
        $this->prefixRoutes = $this->getConfigPrefixRoutes();
        $this->prefixDomain = $this->getConfigPrefixDomain();
    }

    public function setConfigMiddlewareValue()
    {
        $this->middlewareEnable = $this->getConfigMiddlewareEnable();
        $this->middlewareAssign = $this->getConfigMiddlewareAssign();
        $this->middlewareAssets = $this->getConfigMiddlewareAssets();
        $this->middlewareRoutes = $this->getConfigMiddlewareRoutes();
        $this->middlewareRemove = $this->getConfigMiddlewareRemove();
    }

    protected function setConfigURLDefaultValue(): void
    {
        if (! isset($this->getURLDefaultParameters()[$this->getPrefixVariableName()]))
        {
            URL::defaults([$this->getPrefixVariableName() => $this->getPrefixGroupsMain()]);
        }
    }
}
