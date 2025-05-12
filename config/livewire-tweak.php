<?php

return
[
    /*
    |--------------------------------------------------------------------------
    | Livewire Core
    |--------------------------------------------------------------------------
    */

    'core' =>
    [
        'prefix' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE',false),
            'groups' => env('LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS',''),
            'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS','livewire'),
            'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES','livewire'),
            'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true)
        ],

        'middleware' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ENABLE',false),
            'assign' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSIGN',''),
            'assets' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ASSETS',false),
            'routes' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_ROUTES',false),
            'remove' => env('LIVEWIRE_TWEAK_CORE_MIDDLEWARE_REMOVE',false)
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire Flux
    |--------------------------------------------------------------------------
    */

    'flux' =>
    [
        'prefix' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ENABLE',false),
            'groups' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_GROUPS',''),
            'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS','flux'),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES','flux'),
            'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true)
        ],

        'middleware' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ENABLE',false),
            'assign' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ASSIGN',''),
            'assets' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ASSETS',false),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_ROUTES',false),
            'remove' => env('LIVEWIRE_TWEAK_FLUX_MIDDLEWARE_REMOVE',false)
        ]
    ]
];