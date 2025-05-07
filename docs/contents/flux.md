# Prefix for Flux

Through this option, you can add a prefix to the standard path of Livewire Flux assets and routes. Use environment variables.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS="admin/flux"
LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES="admin/flux"
LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN=true
LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES=false
```

This is an example of the result when setting the prefixes mentioned above.

```
https://mydomain.com/admin/flux/flux.js
https://mydomain.com/admin/flux/editor.js
https://mydomain.com/admin/flux/editor.css
```

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN=false
```

All options in the package have default values, so you only need to define the ones you want to customize in your config.

```php
'flux' =>
[
    'prefix' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE',false),
        'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS',''),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES',''),
        'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true),

        'remove_original_routes' => env('LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES',false),
    ]
],
```

By default, new routes are added, but if you want to remove the original routes, simply enable the "remove routes" option.

## Example Output

- [Screenshot of page test](../images/flux-result.jpg)  

## Configuration

The configuration file is optional. If you need to customize, you can publish the config:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```