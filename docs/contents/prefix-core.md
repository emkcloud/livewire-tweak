# Prefix for Livewire

At the time of writing this code, the Livewire package sets assets/routes using absolute paths. This is limiting for my development environment. Here's my solution:

## Assets Prefix

Through this feature, you can add a prefix to the standard path of Livewire assets.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=true
```

This is an example of the result when setting the prefixes mentioned above.

```html
<script src="https://mydomain.com/admin/vendor/livewire/livewire.js"></script>
<script src="https://mydomain.com/admin/vendor/livewire/livewire.min.js"></script>
```

If you prefer to remove the domain name from the resource path, set the following environment variable to false.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=false
```

This is an example of the result when setting option for domain disabled.

```html
<script src="/admin/vendor/livewire/livewire.js"></script>
<script src="/admin/vendor/livewire/livewire.min.js"></script>
```

## Assets Dynamic

If you need to make the prefix dynamic because you want to use different values as the assets prefix, simply define the list of allowed values in the groups option.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin,backend,customers"
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=true
```

This is an example of the result when setting the prefixes mentioned above.

```html
<script src="https://mydomain.com/{assetwire}/vendor/livewire/livewire.js"></script>
<script src="https://mydomain.com/{assetwire}/vendor/livewire/livewire.min.js"></script>
```

The first value in the list will be used as the default prefix, in this case `admin`. If you want to change it to a different value, use this command in your service provider.

```php
URL::defaults(['assetwire' => 'backend']);
```

This is an example of the result when setting the manual prefix with `backend` value.

```html
<script src="https://mydomain.com/backend/vendor/livewire/livewire.js"></script>
<script src="https://mydomain.com/backend/vendor/livewire/livewire.min.js"></script>
```

If you want to change not only the prefix but also the default path `vendor/livewire`, set the following options.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS="custom/path"
```

This is an example of the result when setting the prefixes mentioned above.

```html
<script src="https://mydomain.com/admin/custom/path/livewire.js"></script>
<script src="https://mydomain.com/admin/custom/path/livewire.min.js"></script>
```

## Assets Advice

If the `asset_url` variable is set in the Livewire configuration file, the asset prefix settings described above will be ignored. The `asset_url` value takes precedence.

## Routes Prefix

Through this feature, you can add a prefix to the standard URL of Livewire routes.

```
GET|HEAD livewire/livewire.js ...................................................
GET|HEAD livewire/livewire.min.js.map ...........................................
GET|HEAD livewire/preview-file/{filename} ... livewire.preview-file .............
POST     livewire/update ... livewire.update ....................................
POST     livewire/upload-file ... livewire.upload-file ..........................
```

Use environment variables for change default path and add custom prefix.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/livewire/livewire.js .............................................
GET|HEAD admin/livewire/livewire.min.js.map .....................................
GET|HEAD admin/livewire/preview-file/{filename} ... livewire.preview-file .......
POST     admin/livewire/update ... livewire.update ..............................
POST     admin/livewire/upload-file ... livewire.upload-file ....................
```

If you want to change not only the prefix but also the default path `livewire`, set the following options.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES="custom/path"
```

After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD admin/custom/path/livewire.js ..........................................
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
GET|HEAD {groupwire}/livewire/livewire.js .......................................
GET|HEAD {groupwire}/livewire/livewire.min.js.map ...............................
GET|HEAD {groupwire}/livewire/preview-file/{filename} ... livewire.preview-file .
POST     {groupwire}/livewire/update ... livewire.update ........................
POST     {groupwire}/livewire/upload-file ... livewire.upload-file ..............
```

By default, the value of `{groupwire}` will be set to `admin` value since it is the first element in the groups option. If you want to change it at runtime, use this command in your service provider.

```php
URL::defaults(['groupwire' => 'backend']);
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
        'groups' => env('LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS',''),
        'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS','vendor/livewire'),
        'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES','livewire'),
        'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true)
    ]
];
```

## Variables

To view all available variables and their meanings, refer to the following file:

> [Environment variables](../../examples/variables.env)

## Example Output

- CAMBIARE!!!!! [Screenshot of route:list](../images/core-routes.jpg)  

## License

The MIT License (MIT). Please see the package [License file](../../LICENSE) for more information.