@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        Productions ({{$count}}):
    </div>
    <div>
        @if(isset($productions))
                @foreach($productions as $production)
                    <h1>{{ $production->title }}</h1>
                    <h4>Type: {{ $production->type }}</h4>
                    <ul>
                        @foreach($production->sites as $site)
                            <li><strong>Site:</strong> {{ $site->name }} - <strong>Shoot Date:</strong> {{ $site->shoot_date }}</li>
                        @endforeach
                    </ul>
                @endforeach
        @endif
    </div>
@endsection
