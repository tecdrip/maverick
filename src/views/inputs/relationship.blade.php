<select class="form-control" name="{{ $column->Field }}">
    @foreach($model->all() as $model)
        <option value="{{ $model->id }}">{{ $model->name }}</option>
    @endforeach
</select>