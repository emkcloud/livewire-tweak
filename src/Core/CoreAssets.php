<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

class CoreAssets extends BaseAssets
{
    protected $prefixConstant = CorePrefix::class;

    protected $prefixVariable = '{assetswire}';

    protected function startAssetsPrefixAddon(): void
    {
        if (is_null(config('livewire.asset_url')))
        {
            if ($this->isAllowedToChangeAssets())
            {
                $originalAsset = $this->getLivewireOriginalAsset();

                $originalPathU = parse_url($originalAsset, PHP_URL_PATH);
                $originalQuery = parse_url($originalAsset, PHP_URL_QUERY);

                $livewireAsset = empty($originalQuery)
                    ? $this->replacePrefixDomain().basename($originalPathU)
                    : $this->replacePrefixDomain().basename($originalPathU).'?'.$originalQuery;

                config(['livewire.asset_url' => $livewireAsset]);
            }
        }
    }

    protected function getLivewireOriginalAsset(): ?string
    {
        $originalscript = app(FrontendAssets::class)->js([]);

        preg_match('/src="([^"]+)"/', $originalscript, $matches);

        return $matches[1] ?? null;
    }
}
