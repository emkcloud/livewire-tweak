# Prefix for Livewire

At the time of writing this code, the Flux package sets assets/routes using absolute paths. This is limiting for my development environment. Here's my solution:

## Assets Prefix

Through this feature, you can add a prefix to the standard path of Livewire assets. Use environment variables.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS="admin/vendor/livewire"
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=true
```

This is an example of the result when setting the prefixes mentioned above.

```
https://mydomain.com/admin/vendor/livewire/livewire.js
https://mydomain.com/admin/vendor/livewire/livewire.min.js
```

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=false
```

## Assets Advice

> **Important:** If the `asset_url` variable is set in the Livewire configuration file, the asset prefix settings described above will be ignored. The `asset_url` value takes precedence.

## Routes Prefix

Through this feature, you can add a prefix to the standard URL of Livewire Flux routes.

```
GET|HEAD livewire/livewire.js .......... Livewire\Mechanisms › FrontendAssets@returnJavaScrip
GET|HEAD livewire/livewire.min.js.map .................... Livewire\Mechanisms › FrontendAsse
GET|HEAD livewire/preview-file/{filename} livewire.preview-file › Livewire\Features › FilePre
POST     livewire/update ....... livewire.update › Livewire\Mechanisms › HandleRequests@handl
POST     livewire/upload-file livewire.upload-file › Livewire\Features › FileUploadController
```

Use environment variables for change default path and add custom prefix.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_CUSTOM=false
LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES="admin/livewire"
LIVEWIRE_TWEAK_CORE_REMOVE_ROUTES=false
```
After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/livewire/livewire.js .......... Livewire\Mechanisms › FrontendAssets@returnJav
GET|HEAD admin/livewire/livewire.min.js.map .................... Livewire\Mechanisms › Fronte
GET|HEAD admin/livewire/preview-file/{filename} livewire.preview-file › Livewire\Features › F
POST     admin/livewire/update ....... livewire.update › Livewire\Mechanisms › HandleRequests
POST     admin/livewire/upload-file livewire.upload-file › Livewire\Features › FileUploadCont
```

By default, new routes are added, but if you want to remove the original routes, simply enable the "remove routes" option.

```ini
LIVEWIRE_TWEAK_CORE_REMOVE_ROUTES=true
```

## Configuration

The configuration file is optional. If you need to customize, you can publish the config:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```

## File livewire-tweak.php

```php
'core' =>
[
    'prefix' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE',false),
        'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS',''),
        'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES',''),
        'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true),
        'remove' => env('LIVEWIRE_TWEAK_CORE_REMOVE_ROUTES',false)
    ]
],
```

## Example Output

- [Screenshot of route:list](../images/core-routes.jpg)  
- [Screenshot of route:list with remove](../images/core-routes-remove.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE) for more information.