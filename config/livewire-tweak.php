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
            'assets' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_ASSETS','vendor/livewire'),
            'routes' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_ROUTES','livewire'),
            'domain' => env('LIVEWIRE_TWEAK_CORE_CUSTOM_DOMAIN',true)
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
            'assets' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ASSETS','flux'),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_ROUTES','flux'),
            'domain' => env('LIVEWIRE_TWEAK_FLUX_CUSTOM_DOMAIN',true)
        ]
    ]
];
