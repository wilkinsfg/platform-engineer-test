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
                    <ul>
                        <li>{{ $production->type }}</li>
                        @foreach($production->sites as $site)
                            <ul>
                                <li>{{ $site->name }}</li>
                                <li>{{ $site->shoot_date }}</li>
                            </ul>
                        @endforeach
                    </ul>
                @endforeach

        @endif
    </div>
@endsection
