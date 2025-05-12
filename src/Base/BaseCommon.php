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

    public function __construct()
    {
        $this->prefixEnable = $this->getConfigPrefixEnable();
        $this->prefixGroups = $this->getConfigPrefixGroups();
        $this->prefixAssets = $this->getConfigPrefixAssets();
        $this->prefixRoutes = $this->getConfigPrefixRoutes();
        $this->prefixDomain = $this->getConfigPrefixDomain();

        $this->setDefaultValueURL();
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

    protected function setDefaultValueURL(): void
    {
        if (! isset($this->getURLDefaultParameters()[$this->getPrefixVariableName()]))
        {
            URL::defaults([$this->getPrefixVariableName() => $this->getPrefixGroupsMain()]);
        }
    }
}
