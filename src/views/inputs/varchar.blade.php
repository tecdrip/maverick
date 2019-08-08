<div class="form-group">
    <label for="{{ $column->Field }}">{{ $column->FieldDisplayName }}</label>

    @if($column->Field == "state")
        <select class="form-control" name="{{ $column->Field }}">
            @include('maverick::inputs.common.states')
        </select>
    @else
        <input class="form-control" type="number" name="{{ $column->Field }}" @if(@$column->Type['length']) maxlength='{{ $column->Type['length'] }}' @endif />
    @endif

    {{ @$column->Model->table }}
    
</div>