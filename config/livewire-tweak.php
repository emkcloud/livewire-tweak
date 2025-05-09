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
            'groups' => env('LIVEWIRE_TWEAK_CORE_PREFIX_GROUPS',''),
            'assets' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_CORE_PREFIX_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_CORE_PREFIX_DOMAIN',true)
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
            'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS',''),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES',''),
            'domain' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_DOMAIN',true)
        ]
    ]
];
