<select class="form-control" name="{{ $column->Field }}">
    @foreach($model->all() as $model)
        <option value="NULL">None</option>
        <option value="{{ $model->id }}">{{ $model->name }}</option>
    @endforeach
</select>