<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Support\Str;

class BaseAssets
{
    protected $constantsClass;

    protected $packagesPrefix;

    protected $originalPrefix;

    public function __construct()
    {
        $this->packagesPrefix = $this->getAssetPrefix();
    }

    public function init() {}

    public function start(): void
    {
        $this->startAssets();
        $this->startAssetsDirective();
    }

    protected function startAssets(): void {}

    protected function startAssetsDirective(): void {}

    protected function checkAssetsDomain(): bool
    {
        if (class_exists($this->constantsClass))
        {
            return BaseConfig::value($this->constantsClass::DOMAIN) == true;
        }

        return false;
    }

    protected function checkAssetsPrefix(): bool
    {
        if (class_exists($this->constantsClass))
        {
            return BaseConfig::value($this->constantsClass::ENABLE) == true;
        }

        return false;
    }

    protected function finish($value): ?string
    {
        return Str::finish($value,'/');
    }

    protected function getAssetPrefix(): ?string
    {
        if (class_exists($this->constantsClass))
        {
            return BaseConfig::value($this->constantsClass::ASSETS);
        }

        return null;
    }

    protected function getOriginalPrefix(): ?string
    {
        return $this->originalPrefix;
    }

    protected function getPackagesPrefix(): ?string
    {
        return $this->packagesPrefix;
    }

    protected function applyPrefixDomain(): string
    {
        if ($this->checkAssetsDomain())
        {
            return $this->finish(url('/')).$this->finish($this->getPackagesPrefix());
        }

        return $this->finish(parse_url(url('/'), PHP_URL_PATH)).$this->finish($this->getPackagesPrefix());
    }

    protected function applyPrefixToHref($output): string
    {
        if ($this->getPackagesPrefix() && $this->checkAssetsPrefix())
        {
            $source = '#href="'.$this->getOriginalPrefix().'#';
            $target = 'href="'.$this->applyPrefixDomain();

            return preg_replace($source, $target, $output);
        }

        return $output;
    }

    protected function applyPrefixToSrc($output): string
    {
        if ($this->getPackagesPrefix() && $this->checkAssetsPrefix())
        {
            $source = '#src="'.$this->getOriginalPrefix().'#';
            $target = 'src="'.$this->applyPrefixDomain();

            return preg_replace($source, $target, $output);
        }

        return $output;
    }
}
