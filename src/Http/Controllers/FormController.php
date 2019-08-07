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
        $modelName = ucfirst($modelName);

        $model = resolve('App\\' . $modelName);

        $describer = new TableDescriber($model->getTable());

        dd($describer);

        return "Hello, $modelName";
    }
}
