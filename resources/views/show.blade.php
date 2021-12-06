@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        Productions:
    </div>
    <div>
        @if(isset($productions))
            <h1>{{$count}}</h1>
            <ul>
                @foreach($productions as $item)
                    <li>{{ $item->title }}</li>
                    <li>{{ $item->type }}</li>
                    @foreach($item->sites as $site)
                        <li>{{ $item->name }}</li>
                        <li>{{ $item->shoot_date }}</li>
                    @endforeach
                @endforeach
            </ul>
        @endif
    </div>
@endsection
