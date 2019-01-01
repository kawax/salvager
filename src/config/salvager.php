<?php
return [
    'chrome' => [
        '--disable-gpu',
        '--headless',
        '--window-size=1920,1080',

        /**
         * for Docker
         */
        // '--no-sandbox',
        // '--disable-dev-shm-usage',
    ],

    'screenshots' => storage_path('salvager/screenshots'),
    'console'     => storage_path('salvager/console'),
];
