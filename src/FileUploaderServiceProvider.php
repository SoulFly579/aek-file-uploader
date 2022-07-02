<?php

namespace AEK\FileUploader;

use Illuminate\Support\ServiceProvider;

class FileUploaderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__."/config/fileUploader.php" => config_path("fileUploader.php")
        ]);
    }

    public function register()
    {

    }
}
