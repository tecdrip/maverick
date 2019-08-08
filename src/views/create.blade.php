@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create {{ ucfirst($modelName) }}</div>

                {{ Breadcrumbs::render('dealer/create') }}
                
                <div class="card-body">
                    
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST">
                        @csrf 
                        
                        <div class="container">
                            
                            @foreach($columns->chunk(2) as $pair)
                                <div class="row">
                                    @foreach($pair as $column)
                                    <div class="col-lg-6">
                                        @includeIf('maverick::inputs.' . $column->Type['name'], [$column])
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>


                        <button class="btn btn-success">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection