<?php

return [

    /*
    |--------------------------------------------------------------------------
    | File System
    |--------------------------------------------------------------------------
    |
    | Here you may specify which storage method you will use
    |
    */

    "default" => env("FILE_STORAGE_METHOD","storage"),

    "drivers" => [
        "storage",
        "without_storage"
    ]
];
