<?php
namespace Travierm\Maverick\Services;

use DB;

class TableDescriber {
    public $columns = [];

    function __construct($tableName)
    {
        $columnRelationships = config('maverick.column_relationships');


        $this->columns = DB::select("describe $tableName");

        foreach($this->columns as &$column) {
            $model = @$columnRelationships[$column->Field];
            if(@$model) {
                $model = resolve($model);

                $canUse = in_array('name', $model->getFillable());
                if($canUse) {
                    $column->Model = $model;
                }
            }

            $column->FieldDisplayName = ucwords(str_replace("_", " ", $column->Field));
            $column->Type = $this->formatType($column->Type);
        }

        $this->removeBadColumns();
    }

    private function removeBadColumns()
    {
        $badColumns = [
            'id',
            'created_at',
            'updated_at',
            'email_verified_at',
            'remember_token'
        ];

        $this->columns = array_map(function($col) use($badColumns) {
            if(in_array($col->Field, $badColumns)) {
                return false;
            }

            return $col;
        }, $this->columns);

        $this->columns = array_filter($this->columns);
    }

    private function formatType($rawType)
    {
        
        $rawType = explode(" ", $rawType)[0];

        preg_match('/([a-zA-Z\s]*)\((.*)\)$/', $rawType , $type);

        if(!@$type[1]) {
            return false;
        }

        return [
            'name' => $type[1],
            'raw' => $type[0],
            'length' => $type[2]
        ];
    }
}
?>