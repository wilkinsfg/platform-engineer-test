@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        Productions:
    </div>
    <div>
        @if(isset($productions))
            <h1>{{$count}}</h1>
            <ol>
                @foreach($productions as $production)
                    <li>{{ $production->title }}</li>
                    <li>{{ $production->type }}</li>
                    @foreach($production->sites as $site)
                        <ul>
                            <li>{{ $site->name }}</li>
                            <li>{{ $site->shoot_date }}</li>
                        </ul>
                    @endforeach
                @endforeach
            </ol>
        @endif
    </div>
@endsection
