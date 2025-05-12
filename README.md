# livewire-tweak

**Custom tweaks for Livewire and Flux**

Blade directives, script output, and internal behavior have been adjusted. Custom prefixes were added to the default assets to ensure proper use in load-balanced environments.

**Why this package exists**

I built this package based on my experience working with clients who use firewalls and traffic load balancers that rely on custom URL prefixes such as `/admin`, `/backend`, `/customers`, etc. 

In these environments, using popular Laravel packages like Nova, Livewire, or others can be problematic, because they often rely on absolute paths for assets and internal API calls.  

## Features

- [Livewire Core Prefix](docs/contents/core-prefix.md)
- [Livewire Core Middleware](docs/contents/middleware-prefix.md)
- [Livewire Flux Prefix](docs/contents/flux-prefix.md)
- [Livewire Flux Middleware](docs/contents/middleware-prefix.md)

## Requirements

- Laravel ^12
- Livewire ^3.6
- Livewire Flux ^2.0 (optional)
- Livewire Flux PRO ^2.0 (optional)

## Installation

```bash
composer require emkcloud/livewire-tweak
```

## Configuration

The configuration file is optional. You can simply define the variables directly in your .env file. However, if you need to customize the options, you can publish the configuration file:

```bash
php artisan vendor:publish --tag=livewire-tweak:config
```

All options in the package have default values, so you only need to define the ones you want to customize in your configuration file.

```ini
LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE=false
LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS=""
LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS="livewire"
LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES="livewire"
LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN=true
```

```ini
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE=false
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN=""
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSETS=false
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES=false
LIVEWIRE_TWEAK_CORE_MIDDLEWARE_REMOVE=false
```

## Environment

To view all available variables and their meanings, refer to the following file:

> [Environment variables](examples/variables.env)

## License

The MIT License (MIT). Please see the package [License file](LICENSE.md) for more information.