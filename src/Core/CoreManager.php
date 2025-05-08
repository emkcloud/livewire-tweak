<?php

namespace Emkcloud\LivewireTweak\Core;

use Emkcloud\LivewireTweak\Base\BaseManager;

class CoreManager
{
    public function getRoutePrefix(): ?string
    {
        return BaseManager::getConfigPrefix(CorePrefix::ROUTES);
    }
}
