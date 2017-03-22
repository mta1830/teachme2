@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="title-show">
                    {{ trans(Route::currentRouteName().'_title') }}
                </h2>
                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                <p>
                    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection