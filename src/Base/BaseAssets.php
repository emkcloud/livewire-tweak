<?php

namespace Emkcloud\LivewireTweak\Base;

class BaseAssets
{
    protected $packagesPrefix;

    protected $originalPrefix;

    public function __construct()
    {
        $this->packagesPrefix = $this->getAssetPrefix();
    }

    public function init() {}

    public function checkAssetsPrefix(): bool
    {
        return false;
    }

    public function checkAssetsDomain(): bool
    {
        return false;
    }

    public function start(): void
    {
        $this->startAssetsDirective();
    }

    public function getAssetPrefix(): ?string
    {
        return null;
    }

    public function getOriginalPrefix(): ?string
    {
        return $this->originalPrefix;
    }

    public function getPackagesPrefix(): ?string
    {
        return $this->packagesPrefix;
    }

    public function startAssetsDirective(): void {}

    public function applyPrefixDomain(): string
    {
        if (! $this->checkAssetsDomain())
        {
            return url('/').$this->getPackagesPrefix();
        }

        return parse_url(url('/'), PHP_URL_PATH).$this->getPackagesPrefix();
    }

    public function applyPrefixToHref($output): string
    {
        if ($this->getPackagesPrefix() && $this->checkAssetsPrefix())
        {
            $source = '#href="'.$this->getOriginalPrefix().'#';
            $target = 'href="'.$this->applyPrefixDomain();

            return preg_replace($source, $target, $output);
        }

        return $output;
    }

    public function applyPrefixToSrc($output): string
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
