# Prefix for Flux

At the time of writing this code, the Flux package sets assets/routes using absolute paths. This is limiting for my development environment. Here's my solution:

## Blade directives

To avoid using an intrusive technique and to always be able to use the original components, I created aliases for the Blade directives. So, if you want to use the custom prefixes, replace these directives:

```blade
<head>
    ...
-   @fluxAppearance (remove)
+   @livewireTweakFluxAppearance (add)
</head>
<body>
    ...
-    @fluxScripts (remove)
+    @livewireTweakFluxScripts (add)
</body>
```

## Assets Prefix

Through this feature, you can add a prefix to the standard path of Livewire Flux assets. Use environment variables.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS="admin/flux"
LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN=true
```

This is an example of the result when setting the prefixes mentioned above.

```
https://mydomain.com/admin/flux/flux.js
https://mydomain.com/admin/flux/flux.min.js
https://mydomain.com/admin/flux/editor.js
https://mydomain.com/admin/flux/editor.min.js
https://mydomain.com/admin/flux/editor.css
```

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN=false
```

## Routes Prefix

Through this feature, you can add a prefix to the standard URL of Livewire Flux routes.

```
GET|HEAD flux/editor.css ............... Flux\AssetManager@editorCss › AssetManager@editorCss
GET|HEAD flux/editor.js .................. Flux\AssetManager@editorJs › AssetManager@editorJs
GET|HEAD flux/editor.min.js ........ Flux\AssetManager@editorMinJs › AssetManager@editorMinJs
GET|HEAD flux/flux.js ........................ Flux\AssetManager@fluxJs › AssetManager@fluxJs
GET|HEAD flux/flux.min.js .............. Flux\AssetManager@fluxMinJs › AssetManager@fluxMinJs
```

Use environment variables for change default path and add custom prefix.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES="admin/flux"
```
After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/flux/editor.css ......... Flux\AssetManager@editorCss › AssetManager@editorCss
GET|HEAD admin/flux/editor.js ............ Flux\AssetManager@editorJs › AssetManager@editorJs
GET|HEAD admin/flux/editor.min.js .. Flux\AssetManager@editorMinJs › AssetManager@editorMinJs
GET|HEAD admin/flux/flux.js .................. Flux\AssetManager@fluxJs › AssetManager@fluxJs
GET|HEAD admin/flux/flux.min.js ........ Flux\AssetManager@fluxMinJs › AssetManager@fluxMinJs
```

By default, new routes are added, but if you want to remove the original routes, simply enable the "remove routes" option.

```ini
LIVEWIRE_TWEAK_FLUX_ROUTES_REMOVE=true
```

## Configuration

The configuration file is optional. If you need to customize, you can publish the config:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```

## File livewire-tweak.php

```php
'flux' =>
[
    'prefix' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE',false),
        'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS',''),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES',''),
        'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true)
    ],

    'custom' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ENABLE',false),
        'prefix' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_PREFIX',''),
        'assets' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ASSETS','flux'),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ROUTES','flux'),
        'domain' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_DOMAIN',true)
    ],

    'routes' =>
    [
        'remove' => env('LIVEWIRE_TWEAK_FLUX_ROUTES_REMOVE',false)
    ]
]
```

## Dynamic Prefix

The management of the standard prefix appends a suffix to the default path, and this remains valid throughout the entire Laravel project. For a more dynamic approach, consider using the 'custom' options described in this documentation:

## Variables

To view all available variables and their meanings, refer to the following file:

- [Environment variables](../../examples/variables.env)

## Example Output

- [Screenshot of page test](../images/flux-result.jpg)  
- [Screenshot of route:list](../images/flux-routes.jpg)  
- [Screenshot of route:list with remove](../images/flux-routes-remove.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE) for more information.