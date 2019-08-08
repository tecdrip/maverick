<?php

Route::get('maverick', function(){
    return 'Maverick has been installed successfully!';
});


Route::middleware(['web'])->group(function() {
    foreach(config('maverick.models') as $modelName)
    {
        $modelName = strtolower($modelName);

        Route::get("{modelName}/list", 'Travierm\Maverick\Http\Controllers\FormController@list')->name($modelName . '/list');
        Route::get("{modelName}/create", 'Travierm\Maverick\Http\Controllers\FormController@create')->name($modelName . '/create');

        Route::post("{modelName}/create", 'Travierm\Maverick\Http\Controllers\FormController@postCreate');
        // Route::get("{model}/list", 'FormController@list');
    }
});

?>