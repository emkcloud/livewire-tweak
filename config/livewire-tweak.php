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
            'assets' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ASSETS'),
            'routes' => env('LIVEWIRE_TWEAK_FLUX_PREFIX_ROUTES'),
        ],

        'remove_original_routes' => env('LIVEWIRE_TWEAK_FLUX_REMOVE_ROUTES'),
    ],
];
