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

            'remove_original_routes' => env('LIVEWIRE_TWEAK_CORE_REMOVE_ROUTES',false),
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
            'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true),
            'remove' => env('LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES',false),
        ]
    ]
];
