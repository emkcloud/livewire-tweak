<?php

return
[
    /*
    |--------------------------------------------------------------------------
    | Livewire Flux
    |--------------------------------------------------------------------------
    */

    'flux' =>
    [
        'prefix' =>
        [
            'assets' => env('LIVEWIRE_TWEAK_PREFIX_ASSETS', 'laravel/flux'),
            'routes' => env('LIVEWIRE_TWEAK_PREFIX_ROUTES', 'laravel/flux'),
        ],

        'remove_original_routes' => env('LIVEWIRE_TWEAK_REMOVE_ROUTES'),
    ],
];
