<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BaseCommon
{
    protected $constantPrefix = null;

    protected $originalPrefix = null;

    protected $resultedEnable = false;

    protected $resultedGroups = [];

    protected $resultedAssets = null;

    protected $resultedRoutes = null;

    protected $resultedDomain = false;

    protected $resultedMiddle = [];

    protected $variablePrefix = false;

    public function __construct()
    {
        $this->resultedEnable = $this->getConfigPrefixEnable();
        $this->resultedGroups = $this->getConfigPrefixGroups();
        $this->resultedAssets = $this->getConfigPrefixAssets();
        $this->resultedRoutes = $this->getConfigPrefixRoutes();
        $this->resultedDomain = $this->getConfigPrefixDomain();
        $this->resultedMiddle = $this->getConfigPrefixMiddle();

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
        if (class_exists($this->constantPrefix))
        {
            return filter_var(config($this->constantPrefix::ENABLE), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigPrefixGroups(): array
    {
        if (class_exists($this->constantPrefix))
        {
            if (is_string(config($this->constantPrefix::GROUPS)))
            {
                return array_map(function ($item)
                {
                    return $this->getTrimPath($item);

                }, explode(',', config($this->constantPrefix::GROUPS)));
            }
        }

        return [];
    }

    protected function getConfigPrefixAssets(): ?string
    {
        if (class_exists($this->constantPrefix))
        {
            if (is_string(config($this->constantPrefix::ASSETS)))
            {
                return $this->getTrimPath(config($this->constantPrefix::ASSETS)) ?: null;
            }
        }

        return null;
    }

    protected function getConfigPrefixRoutes(): ?string
    {
        if (class_exists($this->constantPrefix))
        {
            if (is_string(config($this->constantPrefix::ROUTES)))
            {
                return $this->getTrimPath(config($this->constantPrefix::ROUTES)) ?: null;
            }
        }

        return null;
    }

    protected function getConfigPrefixDomain(): bool
    {
        if (class_exists($this->constantPrefix))
        {
            return filter_var(config($this->constantPrefix::DOMAIN), FILTER_VALIDATE_BOOLEAN);
        }

        return false;
    }

    protected function getConfigPrefixMiddle(): array
    {
        if (class_exists($this->constantPrefix))
        {
            if (is_string(config($this->constantPrefix::MIDDLE)))
            {
                return array_map(function ($item)
                {
                    return Str::trim($item);

                }, explode(',', config($this->constantPrefix::MIDDLE)));
            }
        }

        return [];
    }

    protected function getCurrentPrefixPath(): ?string
    {
        return parse_url(url('/'), PHP_URL_PATH);
    }

    protected function getPrefixEnable(): bool
    {
        return $this->resultedEnable;
    }

    protected function getPrefixGroups(): array
    {
        return $this->resultedGroups;
    }

    protected function getPrefixGroupsMain(): ?string
    {
        return $this->getPrefixGroups()[0] ?? null;
    }

    protected function getPrefixAssets(): ?string
    {
        return $this->resultedAssets;
    }

    protected function getPrefixRoutes(): ?string
    {
        return $this->resultedRoutes;
    }

    protected function getPrefixDomain(): bool
    {
        return $this->resultedDomain;
    }

    protected function getPrefixMiddle(): array
    {
        return $this->resultedMiddle;
    }

    protected function getPrefixOriginal(): ?string
    {
        return $this->originalPrefix;
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
        if (isset($this->getURLDefaultParameters()[$this->getVariablePrefixName()]))
        {
            return $this->getURLDefaultParameters()[$this->getVariablePrefixName()];
        }

        return $this->getPrefixGroupsMain();
    }

    protected function getVariablePrefix(): ?string
    {
        return $this->variablePrefix;
    }

    protected function getVariablePrefixName(): ?string
    {
        return Str::trim($this->getVariablePrefix(), '{}');
    }

    protected function setDefaultValueURL(): void
    {
        if (! isset($this->getURLDefaultParameters()[$this->getVariablePrefixName()]))
        {
            URL::defaults([$this->getVariablePrefixName() => $this->getPrefixGroupsMain()]);
        }
    }
}
