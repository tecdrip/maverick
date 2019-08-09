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
        Route::get("{modelName}/update/{id}", 'Travierm\Maverick\Http\Controllers\FormController@update')->name($modelName . '/update');
        Route::get("{modelName}/delete/{id}", 'Travierm\Maverick\Http\Controllers\FormController@delete')->name($modelName . '/delete');

        Route::post("{modelName}/create", 'Travierm\Maverick\Http\Controllers\FormController@postCreate');
        Route::post("{modelName}/update/{id}", 'Travierm\Maverick\Http\Controllers\FormController@postUpdate');


        // Route::get("{model}/list", 'FormController@list');
    }
});

?>