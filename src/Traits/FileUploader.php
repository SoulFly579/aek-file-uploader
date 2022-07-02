<?php

namespace AEK\FileUploader\Traits;

use AEK\FileUploader\Services\StorageMethodFileUploader;

trait FileUploader{
    public $file;
    public $public_path;
    public $real_path;
    public $fileService;
    public $propertyOfKey;
    public $disk;

    public function __construct()
    {
        $default_method_for_uploader = config("fileUploader.default");
        if($default_method_for_uploader == "storage"){
            $this->fileService = new StorageMethodFileUploader($this->fileUploader);
        }

    }

    public function setKey($key)
    {
        $this->propertyOfKey = $this->fileService->setKey($key);
        return $this;
    }

    public function setDisk($disk)
    {
        $this->disk = $this->fileService->setDisk($disk);
        return $this;
    }


    public function getPublicPathOfFile()
    {
        return $this->public_path = $this->fileService->getPublicPathOfFile();
    }

    public function getRealPathOfFile()
    {
        return $this->real_path = $this->fileService->getRealPathOfFile(parent::getAttribute($this->propertyOfKey["name_of_column"]));
    }

    public function saveFile($file)
    {
        $getPublicPathOfFile = $this->fileService->saveFile($file);
        return parent::setAttribute($this->propertyOfKey["name_of_column"],$getPublicPathOfFile);
    }

    public function isFileExist()
    {
        return $this->fileService->isFileExist(parent::getAttribute($this->propertyOfKey["name_of_column"]));
    }

    public function deleteFile()
    {
        return $this->fileService->deleteFile(parent::getAttribute($this->propertyOfKey["name_of_column"]));
    }

    public function syncFile($file)
    {
        $public_path = $this->fileService->syncFile(parent::getAttribute($this->propertyOfKey["name_of_column"]),$file);
        parent::setAttribute($this->propertyOfKey["name_of_column"],$public_path);
        return $public_path;
    }

}

