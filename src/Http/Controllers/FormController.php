<?php

namespace Tecdrip\Maverick\Http\Controllers;

use DB;
use Hash;
use Schema;
use Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tecdrip\Maverick\Services\TableDescriber;

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
        $route = @Route::current()->uri;
        if(@!$route) {
            return;
        }
        $this->modelName = explode("/", $route)[0];
        $this->model = resolve('App\\' . ucfirst($this->modelName));
        $this->describer = new TableDescriber($this->model->getTable());
    }

    public function list() 
    {
        $modelFillables = $this->model->getFillable();
        $hasNameColumn = in_array('name', $modelFillables);

        $this->modelAll = $hasNameColumn ?
            $this->model::orderBy('name', 'asc')->get()
            :
            $this->model::all();

        $headers = [];
        if (count($this->modelAll) >= 1) {
            $headers = $modelFillables;

            $headers = array_map(function ($header) {
                if ($header == "id") {
                    $header = "ID";
                } else {
                    $header = ucwords($header);
                }

                return $header;
            }, $headers);
        }

        $modelName = $this->modelName;
        $modelAll = $this->modelAll;

        return view('maverick::list', compact('modelName', 'modelAll', 'headers'));
    }

    public function create()
    {
        $columns = $this->describer->columns;    

        return view('maverick::create', [
            'action' => 'create',
            'modelName' => $this->modelName,
            'columns' => $this->describer->index
        ]);
    }

    public function postCreate(Request $request)
    {
        $inputValues = $request->except(['_token']);   

        $columns = $this->describer->columns;

        $validateConditions = [];
        foreach($columns as $column) {
            $validateConditions[$column->Field] = 'required';
        }

        $request->validate($validateConditions);

        $instance = new $this->model;
        foreach($inputValues as $key => $value) {
            if($key == 'password') {
                $value = Hash::make($value);
            }

            $instance->{$key} = $value;
        }

        $saved = $instance->save();

        if($saved) {
            session()->flash('success', "New " . ucwords($this->modelName) . " created");
        }

        return redirect($this->modelName . "/list");
    }

    public function update(Request $request, $id)
    {
        $columns = $this->describer->columns; 

        $instance = $this->model->find($id);

        if(!$instance) {
            session()->flash('error', "Could not find " . ucfirst($this->modelName) . " with ID given");
            return redirect($this->modelName . "/list");
        }

        foreach($columns as &$column) {
            $column->Value = $instance[$column->Field];
        }

        return view('maverick::create', [
            'id' => $id,
            'action' => 'update',
            'modelName' => $this->modelName,
            'columns' => $columns,
        ]);
    }

    public function postUpdate(Request $request, $id)
    {
        $columns = $this->describer->columns;
        $instance = $this->model->find($id);

        if($request->password) {
            $request->password = Hash::make($request->password);
        }

        foreach($columns as &$column) {
            $columnName = $column->Field;

            //request has an update to the model
            if($request->{$columnName} !== $instance->{$columnName}) {
                //make sure new update is not null
                if($request->{$columnName}) {
                    $instance->{$columnName} = $request->{$columnName};
                }
            }
        }

        try {
            $saved = $instance->save();
        } catch (\Throwable $th) {
            throw $th;
        }


        if($saved) {
            session()->flash('success', 'Updated ' . ucfirst($this->modelName));
        }else{
            session()->flash('error', 'Failed to Update ' . ucfirst($this->modelName));
        }

        return redirect($this->modelName . "/list");
    }

    public function delete(Request $request, $id)
    {
        $instance = $this->model::find($id);
        $instance->delete();

        session()->flash('error', 'Deleted ' . ucfirst($this->modelName));

        return redirect($this->modelName . "/list");
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
