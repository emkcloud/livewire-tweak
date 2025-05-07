# Prefix for Flux

Through this option, you can add a prefix to the standard path of Livewire Flux assets and routes. Use environment variables.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS="admin"
LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES="admin"
LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES=false
```
All options in the package have default values, so you only need to define the ones you want to customize in your config.

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

By default, new routes are added, but if you want to remove the original routes, simply enable the "remove routes" option.

## Configuration

The configuration file is optional. You can simply define the variables directly in your .env file. However, if you need to customize the options, you can publish the configuration file:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```