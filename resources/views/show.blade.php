@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        Productions ({{$count}}):
    </div>
    <div>
        @if(isset($productions))
            <ul>
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
            </ul>
        @endif
    </div>
@endsection
