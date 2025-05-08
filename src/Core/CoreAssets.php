<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

class CoreAssets extends BaseAssets
{
    protected $constantsClass = CorePrefix::class;

    protected function startAssets(): void
    {
        if (is_null(config('livewire.asset_url')))
        {
            if ($this->checkAssetsEnable() && $this->getPackagesPrefix())
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

    protected function getOriginalAsset(): ?string
    {
        $originalscript = app(FrontendAssets::class)->js([]);

        preg_match('/src="([^"]+)"/', $originalscript, $matches);

        return $matches[1] ?? null;
    }
}
