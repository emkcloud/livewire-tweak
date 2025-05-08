<?php

namespace Emkcloud\LivewireTweak\Base;

use Illuminate\Support\Str;

class BaseConfig
{
    public static function prefix($config): ?string
    {
        if ($prefix = Str::trim(config($config)))
        {
            return Str::start(Str::finish($prefix, '/'), '/');
        }

        return null;
    }

    public static function value($config): mixed
    {
        return config($config);
    }
}
