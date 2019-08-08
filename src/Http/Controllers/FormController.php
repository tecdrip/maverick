<?php

namespace Travierm\Maverick\Http\Controllers;

use DB;
use Schema;
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
        $fillable = $modelAll[0]->getFillable();
        
        return view('maverick::list', compact('modelName', 'modelAll', 'fillable'));
    }

    public function create($modelName)
    {
        $badColumns = [
            'id'
        ];

        $model = resolve('App\\' . ucfirst($modelName));
        $describer = new TableDescriber($model->getTable());

        $columns = $describer->columns;

        return view('maverick::create', [
            'modelName' => $modelName,
            'columns' => collect($columns)
        ]);
    }

    public function postCreate()
    {
        
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
