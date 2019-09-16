<?php

Route::get('maverick', function(){
    return 'Maverick 1.0.12 is installed correctly!';
});

$middleware = ['web'];
if(is_array(@config('maverick.middleware'))) {
    $middleware = array_merge($middleware, config('maverick.middleware'));
}

Route::middleware($middleware)->group(function() {

    if(!config('maverick.models')) {
        return;
    }

    foreach(config('maverick.models') as $modelName)
    {
        $modelName = strtolower($modelName);

        Route::get("$modelName/list", 'Tecdrip\Maverick\Http\Controllers\FormController@list')->name($modelName . '/list');
        Route::get("$modelName/create", 'Tecdrip\Maverick\Http\Controllers\FormController@create')->name($modelName . '/create');
        Route::get("$modelName/update/{id}", 'Tecdrip\Maverick\Http\Controllers\FormController@update')->name($modelName . '/update');
        Route::get("$modelName/delete/{id}", 'Tecdrip\Maverick\Http\Controllers\FormController@delete')->name($modelName . '/delete');

        Route::post("$modelName/create", 'Tecdrip\Maverick\Http\Controllers\FormController@postCreate');
        Route::post("$modelName/update/{id}", 'Tecdrip\Maverick\Http\Controllers\FormController@postUpdate');

        if($modelName ) {
            //Register Breadcrumbs
            //route("$modelName/list");
            Breadcrumbs::for($modelName . "/list", function ($trail) use($modelName) {
                $trail->push(ucfirst($modelName), route("$modelName/list"));
            });

            Breadcrumbs::for("$modelName/create", function ($trail)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Create', route("$modelName/create"));
            });

            Breadcrumbs::for("$modelName/update", function ($trail, $id)  use($modelName) {
                $trail->parent("$modelName/list");
                $trail->push('Update', route("$modelName/update", $id));
            });
        }

    }
});

?>