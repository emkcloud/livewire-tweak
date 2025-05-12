# Livewire Prefixing

At the time of writing, the Livewire sets asset and route paths using absolute URLs. This behavior is limiting in my development environment. Here's my solution:

## Assets Prefix

This feature allows you to add a prefix to the default Livewire asset paths.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
```

Here's an example of the output using the environment variables setting above.

```html
<script src="https://mydomain.com/admin/livewire/livewire.js"></script>
<script src="https://mydomain.com/admin/livewire/livewire.min.js"></script>
```

## Assets Path

If you want to change not only the prefix but also the default path `livewire`, set the following environment options.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS="custom/path"
```

Here's an example of the output using the environment variables setting above.

```html
<script src="https://mydomain.com/admin/custom/path/livewire.js"></script>
<script src="https://mydomain.com/admin/custom/path/livewire.min.js"></script>
```

## Assets Domain

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=false
```

Here's an example of the output when the domain option is disabled.

```html
<script src="/admin/livewire/livewire.js"></script>
<script src="/admin/livewire/livewire.min.js"></script>
```

## Assets Dynamic

If you need to make the prefix dynamic if you want to use different values as asset prefixes, simply define the list of allowed values in the groups option.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin,backend,customers"
```

This is an example of the result when setting the prefixes mentioned above.

```html
<script src="https://mydomain.com/{assetwire}/livewire/livewire.js"></script>
<script src="https://mydomain.com/{assetwire}/livewire/livewire.min.js"></script>
```

The first value in the list will be used as the default prefix, in this case `admin`. If you want to change it to a different value, use this command in your service provider.

```php
URL::defaults(['assetwire' => 'backend']);
```

Here's an example of the output when manually setting the prefix to `backend`.

```html
<script src="https://mydomain.com/backend/livewire/livewire.js"></script>
<script src="https://mydomain.com/backend/livewire/livewire.min.js"></script>
```

## Assets Advice

If the `asset_url` variable is set in the Livewire configuration file, the prefix settings above will be ignored.

## Routes Prefix

Through this feature, you can add a prefix to the standard URL of Livewire routes.

```
GET|HEAD livewire/livewire.js ...................................................
GET|HEAD livewire/livewire.min.js ...............................................
GET|HEAD livewire/livewire.min.js.map ...........................................
GET|HEAD livewire/preview-file/{filename} ... livewire.preview-file .............
POST     livewire/update ... livewire.update ....................................
POST     livewire/upload-file ... livewire.upload-file ..........................
```

Use environment variables to change the default path and add a custom prefix.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/livewire/livewire.js .............................................
GET|HEAD admin/livewire/livewire.min.js .........................................
GET|HEAD admin/livewire/livewire.min.js.map .....................................
GET|HEAD admin/livewire/preview-file/{filename} ... livewire.preview-file .......
POST     admin/livewire/update ... livewire.update ..............................
POST     admin/livewire/upload-file ... livewire.upload-file ....................
```

## Routes Path

If you want to change not only the prefix but also the default standard path `livewire`, set the following options.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES="custom/path"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/custom/path/livewire.js ..........................................
GET|HEAD admin/custom/path/livewire.min.js ......................................
GET|HEAD admin/custom/path/livewire.min.js.map ..................................
GET|HEAD admin/custom/path/preview-file/{filename} ... livewire.preview-file ....
POST     admin/custom/path/update ... livewire.update ...........................
POST     admin/custom/path/upload-file ... livewire.upload-file .................
```

## Routes Dynamic

If you need to make the prefix dynamic because you want to use different values as the routes prefix, simply define the list of allowed values in the groups option.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin,backend,customers"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD {routewire}/livewire/livewire.js .......................................
GET|HEAD {routewire}/livewire/livewire.min.js ...................................
GET|HEAD {routewire}/livewire/livewire.min.js.map ...............................
GET|HEAD {routewire}/livewire/preview-file/{filename} ... livewire.preview-file .
POST     {routewire}/livewire/update ... livewire.update ........................
POST     {routewire}/livewire/upload-file ... livewire.upload-file ..............
```

By default, the value of `{routewire}` will be set to `admin` value since it is the first element in the groups option. If you want to change it at runtime, use this command:

```php
URL::defaults(['routewire' => 'backend']);
```

## Configuration

The configuration file is optional. If you need to customize, you can publish the config:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```

## File livewire-tweak.php

This is the preview of the prefix section for the Livewire configuration.

```php
'core' =>
[
    'prefix' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE',false),
        'groups' => env('LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS',''),
        'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS','livewire'),
        'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES','livewire'),
        'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true),
    ],

    'middleware' =>
    [
        'enable' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE',false),
        'assign' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN',''),
        'assets' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSETS',false),
        'routes' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES',false),
        'remove' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_REMOVE',false)
    ]
];
```

## Environment

To view all available variables and their meanings, refer to the following file:

> [Environment variables](../../examples/variables.env)

## Example Output

> [Screenshot of route:list static](../images/core-routes-static.jpg)  
> [Screenshot of route:list dynamic](../images/core-routes-dynamic.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE.md) for more information.