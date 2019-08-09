<div class="form-group">
    <label for="{{ $column->Field }}">{{ $column->FieldDisplayName }}</label>
    <select class="form-control" name="{{ $column->Field }}">
        @foreach($column->Options as $option)
            <option @if(@$column->Value == $option) selected @endif  value="{{ $option }}">{{ ucfirst($option) }}</option>
        @endforeach
    </select>
</div>