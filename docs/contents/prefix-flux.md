# Flux Prefixing

At the time of writing, the Livewire Flux sets asset and route paths using absolute URLs. This behavior is limiting in my development environment. Here's my solution:

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

This feature allows you to add a prefix to the default Flux asset paths.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin"
```

Here's an example of the output using the environment variables setting above.

```html
<script src="https://mydomain.com/admin/flux/editor.css"></script>
<script src="https://mydomain.com/admin/flux/editor.js"></script>
<script src="https://mydomain.com/admin/flux/editor.min.js"></script>
<script src="https://mydomain.com/admin/flux/flux.js"></script>
<script src="https://mydomain.com/admin/flux/flux.min.js"></script>
```

## Assets Path

If you want to change not only the prefix but also the default path `flux`, set the following environment options.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS="custom/path"
```

Here's an example of the output using the environment variables setting above.

```html
<script src="https://mydomain.com/admin/custom/path/editor.css"></script>
<script src="https://mydomain.com/admin/custom/path/editor.js"></script>
<script src="https://mydomain.com/admin/custom/path/editor.min.js"></script>
<script src="https://mydomain.com/admin/custom/path/flux.js"></script>
<script src="https://mydomain.com/admin/custom/path/flux.min.js"></script>
```

## Assets Domain

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN=false
```

Here's an example of the output when the domain option is disabled.

```html
<script src="/admin/flux/editor.css"></script>
<script src="/admin/flux/editor.js"></script>
<script src="/admin/flux/editor.min.js"></script>
<script src="/admin/flux/flux.js"></script>
<script src="/admin/flux/flux.min.js"></script>
```

## Assets Dynamic

If you need to make the prefix dynamic if you want to use different values as asset prefixes, simply define the list of allowed values in the groups option.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin,backend,customers"
```

This is an example of the result when setting the prefixes mentioned above.

```html
<script src="https://mydomain.com/{assetflux}/custom/path/editor.css"></script>
<script src="https://mydomain.com/{assetflux}/custom/path/editor.js"></script>
<script src="https://mydomain.com/{assetflux}/custom/path/editor.min.js"></script>
<script src="https://mydomain.com/{assetflux}/custom/path/flux.js"></script>
<script src="https://mydomain.com/{assetflux}/custom/path/flux.min.js"></script>
```

The first value in the list will be used as the default prefix, in this case `admin`. If you want to change it to a different value, use this command in your service provider.

```php
URL::defaults(['assetflux' => 'backend']);
```

Here's an example of the output when manually setting the prefix to `backend`.

```html
<script src="https://mydomain.com/backend/custom/path/editor.css"></script>
<script src="https://mydomain.com/backend/custom/path/editor.js"></script>
<script src="https://mydomain.com/backend/custom/path/editor.min.js"></script>
<script src="https://mydomain.com/backend/custom/path/flux.js"></script>
<script src="https://mydomain.com/backend/custom/path/flux.min.js"></script>
```

## Routes Prefix

Through this feature, you can add a prefix to the standard URL of Flux routes.

```
GET|HEAD flux/editor.css ........................................................
GET|HEAD flux/editor.js .........................................................
GET|HEAD flux/editor.min.js .....................................................
GET|HEAD flux/flux.js ...........................................................
GET|HEAD flux/flux.min.js .......................................................
```

Use environment variables to change the default path and add a custom prefix.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/flux/editor.css ..................................................
GET|HEAD admin/flux/editor.js ...................................................
GET|HEAD admin/flux/editor.min.js ...............................................
GET|HEAD admin/flux/flux.js .....................................................
GET|HEAD admin/flux/flux.min.js .................................................
```

## Routes Path

If you want to change not only the prefix but also the default standard path `flux`, set the following options.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES="custom/path"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/custom/path/editor.css ...........................................
GET|HEAD admin/custom/path/editor.js ............................................
GET|HEAD admin/custom/path/editor.min.js ........................................
GET|HEAD admin/custom/path/flux.js ..............................................
GET|HEAD admin/custom/path/flux.min.js ..........................................
```

## Routes Dynamic

If you need to make the prefix dynamic because you want to use different values as the routes prefix, simply define the list of allowed values in the groups option.

```ini
LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS="admin,backend,customers"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD {routeflux}/flux/editor.css ............................................
GET|HEAD {routeflux}/flux/editor.js .............................................
GET|HEAD {routeflux}/flux/editor.min.js .........................................
GET|HEAD {routeflux}/flux/flux.js ...............................................
GET|HEAD {routeflux}/flux/flux.min.js ..,,,,,,,..................................
```

By default, the value of `{routeflux}` will be set to `admin` value since it is the first element in the groups option. If you want to change it at runtime, use this command:

```php
URL::defaults(['routeflux' => 'backend']);
```

## Configuration

The configuration file is optional. If you need to customize, you can publish the config:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```

## File livewire-tweak.php

This is the preview of the prefix section for the Flux configuration.

```php
'flux' =>
[
    'prefix' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE',false),
        'groups' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS',''),
        'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS','flux'),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES','flux'),
        'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true),
    ]

    'middleware' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ENABLE',false),
        'assign' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ASSIGN',''),
        'assets' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ASSETS',false),
        'routes' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ROUTES',false),
        'remove' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_REMOVE',false)
    ]
];
```

## Environment

To view all available variables and their meanings, refer to the following file:

> [Environment variables](../../examples/variables.env)

## Example Output

> [Screenshot of route:list static](../images/flux-routes-static.jpg)  
> [Screenshot of route:list dynamic](../images/flux-routes-dynamic.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE.md) for more information.