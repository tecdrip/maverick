<?php

Route::get('maverick', function(){
    return 'Maverick has been installed successfully!';
});


foreach(config('maverick.models') as $modelName)
{
    $modelName = strtolower($modelName);

    Route::get("{modelName}/list", 'Travierm\Maverick\Http\Controllers\FormController@list');
    // Route::get("{model}/list", 'FormController@list');
}


?>