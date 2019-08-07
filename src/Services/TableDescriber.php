<?php
namespace Travierm\Maverick\Services;

use DB;

class ColumnType {
    public $name;
    public $length;
    public $raw;
}

class TableDescriber {
    public $columns = [];

    function __construct($tableName)
    {
        $this->columns = DB::select("describe $tableName");

        foreach($this->columns as &$column) {
            $column->Type = $this->formatType($column->Type);
        }
    }

    private function formatType($rawType)
    {
        
        $rawType = explode(" ", $rawType)[0];

        preg_match('/([a-zA-Z\s]*)\((.*)\)$/', $rawType , $type);

        if(!@$type[1]) {
            return false;
        }

        $columnType = new ColumnType();
        $columnType->raw = $type[0];
        $columnType->name = $type[1];
        $columnType->length = $type[2];

        return $columnType;
    }
}
?>