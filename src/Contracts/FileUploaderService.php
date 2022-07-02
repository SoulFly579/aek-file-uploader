<?php

namespace AEK\FileUploader\Contracts;

abstract class FileUploaderService
{

    public $fileUploader;
    public $key;
    public $propertyOfKey;
    public $disk = "local";

    abstract public function setFileName($file);
    abstract public function storeFile();
    abstract public function getPublicPathOfFile();
    abstract public function getRealPathOfFile($path);
    abstract public function saveFile($file);
    abstract public function isFileExist($path);
    abstract public function deleteFile($path);
    abstract public function syncFile($path,$file);

    public function setKey(string $key){
        $this->key = $key;
        if(!in_array($key,array_column($this->fileUploader,"name_of_column"))){
            throw new \Error("Not found column name.",500);
        };
        $index = array_search($key,array_column($this->fileUploader,"name_of_column"));
        return $this->propertyOfKey = $this->fileUploader[$index];
    }

    public function setDisk($disk = "local"){
        return $this->disk = $disk;
    }
}
