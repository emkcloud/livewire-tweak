# Livewire Middleware

Sometimes it can be useful not only to change the route prefix, but also to assign different middleware than the defaults.

# Assign Middleware

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

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE.md) for more information.