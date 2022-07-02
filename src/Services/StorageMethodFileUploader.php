<?php

namespace AEK\FileUploader\Services;

use AEK\FileUploader\Contracts\FileUploaderService as Contracts;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageMethodFileUploader extends Contracts
{

    public $file;
    public $renamed_file;
    public $public_path;
    public $real_path;

    public function __construct($fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function setFileName($file)
    {
        return $this->file = new File($file);
    }

    public function storeFile()
    {
        return $this->renamed_file = Storage::disk($this->disk)->putFile($this->propertyOfKey["visibility"] == "public" ? "public/".$this->propertyOfKey["destination"] :
            $this->propertyOfKey["destination"],$this->file,$this->propertyOfKey["visibility"]);
    }

    public function getPublicPathOfFile()
    {
        return $this->public_path = Str::replace("public","storage",$this->renamed_file);
    }

    public function getRealPathOfFile($path)
    {
        return $this->real_path = Str::replace("storage","public",$path);
    }

    public function saveFile($file)
    {
        $this->setFileName($file);
        $this->storeFile();
        return $this->getPublicPathOfFile();
    }

    public function isFileExist($path)
    {
        return Storage::disk($this->disk)->exists($this->getRealPathOfFile($path));
    }

    public function deleteFile($path)
    {
        $real_path = $this->getRealPathOfFile($path);
        if($this->isFileExist($path)){
            return Storage::disk($this->disk)->delete($real_path);
        }
        return true;
    }

    public function syncFile($path,$file)
    {
        $public_path = $this->saveFile($file);
        $this->deleteFile($path);
        return $public_path;
    }

}
