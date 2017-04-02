@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2 class="title-show">
                {{ $ticket->title }}
                @include('tickets/partials/status', compact('ticket'))
            </h2>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <p class="date-t">
                <span class="glyphicon glyphicon-time"></span> {{ $ticket->created_at->format('d/m/y h:ia') }}

                - Author:<em>{{ $ticket->author->name }}</em>
            </p>
            <h4 class="label label-info news">
                {{ count($ticket->voters) }} votos            </h4>

            <p class="vote-users">
                @foreach($ticket->voters as $voter)
                <span class="label label-info">{{ $voter->name }}</span>
                @endforeach
            </p>

            @if (Auth::check())
                @if( ! currentUser()->hasVoted($ticket))
                {!! Form::open(['route' => ['votes.submit',$ticket],'method' => 'POST']) !!}
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-thumbs-up"></span> Votar
                </button>
                {!! Form::close() !!}
                @else
                {!! Form::open(['route' => ['votes.destroy',$ticket],'method' => 'DELETE']) !!}
                <button type="submit" class="btn btn-danger">
                    <span class="glyphicon glyphicon-thumbs-down"></span> Quitar voto
                </button>
                {!! Form::close() !!}
                @endif
            @endif

            <h3>Nuevo Comentario</h3>

            @include('partials/errors')

            <form action="{{ route('comments.submit',$ticket) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                {{-- {!! Form::open(['route' => ['comments.submit',$ticket],'method' => 'POST']) !!} --}}
                <div class="form-group">
                    <label for="comment">Comentarios:</label>
                    <textarea rows="4" class="form-control" name="comment" cols="50" id="comment">{{ old('comment') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="link">Enlace:</label>
                    <input class="form-control" name="link" type="text" id="link" value="{{ old('link') }}">
                </div>
                <button type="submit" class="btn btn-primary">Enviar comentario</button>
                {{-- {!! Form::close() !!} --}}
            </form>

            <h3>Comentarios ({{ count($ticket->comments) }})</h3>

            @foreach ($ticket->comments as $comment)
                <p><strong>{{ $comment->user->name }}</strong></p>
                <p>{{ $comment->comment }}</p>
                @if($comment->link)
                    <p>
                        <a href="{{ $comment->link }}" rel="nofollow" target="_blank">
                            {{ $comment->link }}
                        </a>
                    </p>
                @endif
                <p class="date-t"><span class="glyphicon glyphicon-time"></span> {{ $comment->created_at->format('d/m/Y h:ia') }}</p>
            @endforeach--

        </div>
    </div>
</div>
@endsection