# Prefix for Livewire

At the time of writing this code, the Flux package sets assets/routes using absolute paths. This is limiting for my development environment. Here's my solution:

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

- [Screenshot of route:list](../images/flux-routes.jpg)  
- [Screenshot of route:list with remove](../images/flux-routes-remove.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE) for more information.