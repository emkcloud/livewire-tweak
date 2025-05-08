<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Emkcloud\LivewireTweak\Base\BaseConfig;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

class CoreAssets extends BaseAssets
{
    public function startAssets(): void
    {
        if (is_null(config('livewire.asset_url')))
        {
            if ($this->getPackagesPrefix() && $this->checkAssetsPrefix())
            {
                $originalAsset = $this->getOriginalAsset();

                $originalPathU = parse_url($originalAsset, PHP_URL_PATH);
                $originalQuery = parse_url($originalAsset, PHP_URL_QUERY);

                $livewireAsset = empty($originalQuery)
                    ? $this->applyPrefixDomain().basename($originalPathU)
                    : $this->applyPrefixDomain().basename($originalPathU).'?'.$originalQuery;

                config(['livewire.asset_url' => $livewireAsset]);
            }
        }
    }

    public function checkAssetsPrefix(): bool
    {
        return config(CorePrefix::ENABLE) == true;
    }

    public function checkAssetsDomain(): bool
    {
        return config(CorePrefix::DOMAIN) == true;
    }

    public function getAssetPrefix(): ?string
    {
        return BaseConfig::prefix(CorePrefix::ASSETS);
    }

    public function getOriginalAsset(): ?string
    {
        $originalscript = app(FrontendAssets::class)->js([]);

        preg_match('/src="([^"]+)"/', $originalscript, $matches);

        return $matches[1] ?? null;
    }
}
