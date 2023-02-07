<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | IMG_PROXY_KEY, IMG_PROXY_SALT та IMG_PROXY_SIGNATURE_SIZE прорисуються в Dockerfile (imgproxy)
    |
    */


    'img_proxy_key'            => env('IMG_PROXY_KEY', '19950f42c412507a80944c342b4e75ac'),
    'img_proxy_salt'           => env('IMG_PROXY_SALT', 'a9c5c9060b417276d86a7b9d8932344a'),
    'img_proxy_signature_size' => env('IMG_PROXY_SIGNATURE_SIZE', 32),
    'img_proxy_url'            => env('IMG_PROXY_URL', 'local:///user.api/storage/app/public/img/'),
];
