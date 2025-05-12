# Livewire Middleware

Sometimes it can be useful not only to change the route prefix, but also to assign different middleware than the defaults.

# Routes Middleware

This feature allows you to add a middleware to the default Livewire middleware.

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN="auth"
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES=true
```

# Multiple Middleware

It is possible to specify more than one middleware by providing multiple values separated by commas.

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN="auth,nocache"
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES=true
```

Middleware names can represent aliases, groups, or even classes.

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN="auth,nocache,api,App\\Http\\Middleware\\ThrottleRequests"
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES=true
```

> Invalid middleware will be ignored.

# Remove Middleware

The specified middleware will be added to the defaults, but this behavior can be changed.

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN="auth,nocache"
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_REMOVE=true
```

> With remove enabled, the default middleware will be removed and only the new ones will be added.

# Assets Middleware

Normally, middleware are not assigned to assets, but we can do it if needed.

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=true
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN="auth,nocache"
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSETS=true
```

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE.md) for more information.