# aek-file-uploader
This is the official repository for the file uploader. 
## Acknowledgements

- Alp Emre Elmas
## Authors

- [Alp Emre Elmas](https://www.github.com/SoulFly579)


## Installation

Install aek-file-uploader with composer

```bash
  composer require 
```

You need to update your application configuration in order to register the package so it can be loaded by Laravel, just update your config/app.php file adding the following code at the end of your 'providers' section:

```bash
config/app.php

<?php

return [
    // ...
    'providers' => [
        \AEK\FileUploader\FileUploaderServiceProvider::class,
        // ...
    ],
    // ...
];
```

For Laravel, you should publish

```bash 
    php artisan vendor:publish --provider="AEK\FileUploader\FileUploaderServiceProvider"
    // or
    php artisan vendor:publish
```


## Usage/Examples

You should define the **destination, visibility, and name_of_column**. The package will upload the file to the destination as you defined visibility and **add the path of the file after uploading as a value to your model as name_of_column variable.**

```php
use AEK\FileUploader\Traits\FileUploader;

class User extends Authenticatable
{
    use FileUploader;

    /* 
        Here you should define a variable which name is $fileUploader and this should be array.
        This array also should has another arrays which include special configurations for each column that you want to add value to the database.  
     */
    public $fileUploader = [
        [
            // this is a folder in which we will keep files
            // each column can have another folder for the keep them in a tidy
            "destination" => "users/profile_pictures",

            // this is visibility of the file "public" or "private"
            "visibility"=> "public",

            // Here, you should define column name of the database 
            "name_of_column" => "profile_picture"
        ],
        [
            "destination" => "users/credit_cards",
            "visibility"=> "private",
            "name_of_column" => "credit_card_picture"
        ]
    ];
}
```

```php
Route::post('/', function (\Illuminate\Http\Request $request) {
        $user = new \App\Models\User();
        $user->name = $request->name;
        // additional values for the model
        $user->setKey("profile_picture")->saveFile($request->file("profile_picture"));
        $user->save();
});
```


## Available Methods

```
Warning: you have to use setKey method before all of the methods.
```
Quick way to upload files.

```php
  $user->setKey("profile_picture")->saveFile($request->profile_picture);
```

#### setKey("key")

We specify the name of the column that we will upload.

```php
  $user->setKey("user");
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `key`      | `string` | **Required**. One of the name_of_column parameters which we defined in the model. |

#### deleteFile()

It doesn't take anything as attribute. It deletes file.

#### syncFile($file)

Takes file which you want to upload and delete previous file.

```php
  $user->syncFile($request->file("profile_picture"));
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `file`      | `file` | **Required**. Delete old file and upload new one |

#### isFileExist()

Checks if file exist in the directory.

```php
  $user->isFileExist();
```


#### getRealPathOfFile()

Returns storage path of the file;

```php
  $user->getRealPathOfFile();
```
