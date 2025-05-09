# Prefix for Livewire

At the time of writing this code, the Livewire package sets assets/routes using absolute paths. This is limiting for my development environment. Here's my solution:

## Assets Prefix

Through this feature, you can add a prefix to the standard path of Livewire assets. Use environment variables.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=true
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin"
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

If the `asset_url` variable is set in the Livewire configuration file, the asset prefix settings described above will be ignored. The `asset_url` value takes precedence.

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
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS="admin,backend,customers"
```
After setting the custom prefix variables, these new routes will be added.

```
GET|HEAD {groupwire}/livewire/livewire.js .......... Livewire\Mechanisms › FrontendAsset
GET|HEAD {groupwire}/livewire/livewire.min.js.map .................... Livewire\Mechanis
GET|HEAD {groupwire}/livewire/preview-file/{filename} livewire.preview-file › Livewire\F
POST     {groupwire}/livewire/update ....... livewire.update › Livewire\Mechanisms › Han
POST     {groupwire}/livewire/upload-file livewire.upload-file › Livewire\Features › Fil
```

By default, the value of `{groupwire}` will be set to `admin` value since it is the first element in the groups option. So it's as if the routes were the following:

```
GET|HEAD admin/livewire/livewire.js ................ Livewire\Mechanisms › FrontendAsset
GET|HEAD admin/livewire/livewire.min.js.map .......................... Livewire\Mechanis
GET|HEAD admin/livewire/preview-file/{filename} ..... livewire.preview-file › Livewire\F
POST     admin/livewire/update ............. livewire.update › Livewire\Mechanisms › Han
POST     admin/livewire/upload-file ..... livewire.upload-file › Livewire\Features › Fil
```

Since the prefix is dynamic, it can also be called at runtime using a custom service provider and run the following command:

```php
URL::defaults(['groupwire' => 'backend']);
```

At this point, we should get the following as the main routes:

```
GET|HEAD backend/livewire/livewire.js .............. Livewire\Mechanisms › FrontendAsset
GET|HEAD backend/livewire/livewire.min.js.map ........................ Livewire\Mechanis
GET|HEAD backend/livewire/preview-file/{filename} ... livewire.preview-file › Livewire\F
POST     backend/livewire/update ........... livewire.update › Livewire\Mechanisms › Han
POST     backend/livewire/upload-file ... livewire.upload-file › Livewire\Features › Fil
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