# Prefix for Livewire Flux

Through this option, you can add a prefix to the standard path of Livewire Flux assets and routes. Simply add the prefix in the environment variables.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS="admin"
LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES="admin"
LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES=false
```
All options in the package have default values, so you only need to define the ones you want to customize in your configuration file.

```php
'flux' =>
[
    'prefix' =>
    [
        'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS'),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES'),
    ],

    'remove_original_routes' => env('LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES'),
],
```

By default, new routes are added with the specified prefix, but if you want to remove the old ones, simply enable the LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES option