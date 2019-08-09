<select class="form-control" name="{{ $column->Field }}">
    <option value="NULL">None</option>
    @foreach($model->all() as $model)
        <option @if(@$column->Value == $model->id) selected @endif  value="{{ $model->id }}">{{ $model->name }}</option>
    @endforeach
</select>