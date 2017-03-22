@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2 class="title-show">
                    {{ trans(Route::currentRouteName().'_title') }}
                </h2>
                @include('partials.errors')
                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('title','Título') !!}
                    {!!
                        Form::textarea('title',null,[
                            'rows' => 2,
                            'class' => 'form-control',
                            'placeholder' => 'Describe brevemente de que quieres que se trate el tutorial',
                        ])
                     !!}
                </div>
                <p>
                    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection