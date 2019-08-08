<?php

namespace Travierm\Maverick\Http\Controllers;

use DB;
use Schema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Travierm\Maverick\Services\TableDescriber;

class FormController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    public function list($modelName) 
    {
        $model = resolve('App\\' . ucfirst($modelName));
        $modelAll = $model::all();

        $fillable = [];
        if(count($modelAll) >= 1) {
            $fillable = $modelAll[0]->getFillable();
        }
        
        return view('maverick::list', compact('modelName', 'modelAll', 'fillable'));
    }

    public function create($modelName)
    {

        $model = resolve('App\\' . ucfirst($modelName));
        $describer = new TableDescriber($model->getTable());

        $columns = $describer->columns;
    

        return view('maverick::create', [
            'modelName' => $modelName,
            'columns' => collect($columns)
        ]);
    }

    public function postCreate(Request $request, $modelName)
    {
        $model = resolve('App\\' . ucfirst($modelName));
        $inputValues = $request->except(['_token']);   
        $describer = new TableDescriber($model->getTable());

        $columns = $describer->columns;

        $validateConditions = [];
        foreach($columns as $column) {
            $validateConditions[$column->Field] = 'required';
        }

        $request->validate($validateConditions);

        $instance = new $model;
        foreach($inputValues as $key => $value) {
            $instance->{$key} = $value;
        }

        $saved = $instance->save();

        if($saved) {
            session()->flash('success', "Created new " . ucwords($model) . "successfully");
        }

        return redirect($modelName . "/list");
    }

    private function formatHeaderArray($headers) 
    {
        foreach($headers as &$header) {
            $header = str_replace("_", " ", $header);
            
            if($header == "id") {
                $header = "ID";
            }else{
                $header = ucwords($header);
            }
        }

        return $headers;
    }
}
