<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Support\Str;

class BaseManager
{
    public static function getConfigPrefix($config): ?string
    {
        if ($prefix = Str::trim(config($config)))
        {
            return Str::start(Str::finish($prefix, '/'), '/');
        }

        return null;
    }
}
