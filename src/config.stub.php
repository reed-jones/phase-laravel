<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Phase SPA blade File
    |--------------------------------------------------------------------------
    |
    | The default `phase::app` will load the default phase blade file. For
    | customization, you will need to create your own entry blade file
    */
    'entry' => 'phase::app',

    'unauthorized' => 'Auth.LoginPage',

    'ssr' => false,

    // https://github.com/spatie/laravel-server-side-rendering
    // 'ssr' => [
    //     'client' => 'js/app-client.js',
    //     'server' => 'js/app-server.js'
    // ],

    'assets' => [
        'scripts' => ['js/app.js'],
        'styles' => ['css/app.css'],
    ],
];
