<?php

return
[
    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    */

    'core' =>
    [
        'prefix' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ENABLE',false),
            'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true)
        ],

        'custom' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_ENABLE',false),
            'prefix' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_PREFIX',''),
            'assets' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_DOMAIN',true)
        ],

        'routes' =>
        [
            'remove' => env('LIVEWIRE_TWEAK_CORE_ROUTES_REMOVE',false)
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
            'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true)
        ],

        'custom' =>
        [
            'enable' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ENABLE',false),
            'prefix' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_PREFIX',''),
            'assets' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_DOMAIN',true)
        ],

        'routes' =>
        [
            'remove' => env('LIVEWIRE_TWEAK_FLUX_ROUTES_REMOVE',false)
        ]
    ]
];
