<div class="form-group">
    <label for="{{ $column->Field }}">{{ $column->FieldDisplayName }}</label>

    @if($column->Field == "state")
        <select class="form-control" name="{{ $column->Field }}">
            @include('maverick::inputs.common.states')
        </select>
    @else
        <input class="form-control @error($column->Field) is-invalid @enderror" type="text" name="{{ $column->Field }}" @if(@$column->Type['length']) maxlength='{{ $column->Type['length'] }}' @endif />
    @endif

    <div class="invalid-feedback">
        Please provide a valid {{ ucwords($column->Field) }}.
    </div>

    {{ @$column->Model->table }}
    
</div>