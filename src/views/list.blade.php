@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ucfirst($modelName) }}</div>

                {{ Breadcrumbs::render('dealer/list') }}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/{{ $modelName }}/create" class="btn btn-success mb-4 float-right">Create {{ $modelName }}</a>

                    <table class="table table-bordered">
                        <tr>
                           @foreach($fillable as $header)
                            <th>{{ $header }}</th>
                           @endforeach
                        </tr>

                        @foreach($modelAll as $model)
                        <tr>
                            @foreach($model->getFillable() as $header)
                            <td>{{ $model->{$header} }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
