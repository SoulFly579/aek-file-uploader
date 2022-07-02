
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

