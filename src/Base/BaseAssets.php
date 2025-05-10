<?php

namespace Emkcloud\LivewireTweak\Base;

class BaseAssets extends BaseCommon
{
    public function start(): void
    {
        $this->startAssetsPrefix();
        $this->startAssetsPrefixAddon();
    }

    protected function startAssetsPrefix(): void {}

    protected function startAssetsPrefixAddon(): void {}

    protected function isAllowedToChangeAssets(): bool
    {
        return $this->checkPrefixEnable() && $this->checkPrefixGroups();
    }

    protected function replacePrefixDomain(): string
    {
        $generatePrefix =
            $this->finishSlash($this->getURLDefaultValue()).
            $this->finishEmpty($this->getPrefixAssets());

        if ($this->checkPrefixDomain())
        {
            return $this->finishSlash(url('/')).$generatePrefix;
        }

        return $this->finishSlash($this->getCurrentPrefixPath()).$generatePrefix;
    }

    protected function replaceTag($tag, $output): string
    {
        if ($this->checkPrefixEnable() && $this->checkPrefixGroups())
        {
            $source = $this->replaceTagSource($tag);
            $target = $this->replaceTagTarget($tag);

            return preg_replace($source, $target, $output);
        }

        return $output;
    }

    protected function replaceTagHref($output): string
    {
        return $this->replaceTag('href', $output);
    }

    protected function replaceTagSrc($output): string
    {
        return $this->replaceTag('src', $output);
    }

    protected function replaceTagSource($tag): string
    {
        return '#'.$tag.'="/'.$this->getPrefixOriginal().'/#';
    }

    protected function replaceTagTarget($tag): string
    {
        return $tag.'="'.$this->replacePrefixDomain();
    }
}
