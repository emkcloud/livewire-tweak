<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseAssets;
use Emkcloud\LivewireTweak\Base\BaseConfig;

class CoreAssets extends BaseAssets
{
    public function checkAssetsPrefix(): bool
    {
        return config(CorePrefix::ENABLE) == true;
    }

    public function checkAssetsDomain(): bool
    {
        return config(CorePrefix::REMOVE) == true;
    }

    public function getAssetPrefix(): ?string
    {
        return BaseConfig::prefix(CorePrefix::ASSETS);
    }
}
