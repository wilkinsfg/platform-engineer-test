@extends('layouts.app')

@section('title', 'Here is your data')

@section('content')
    <div class="step">
        Productions:
    </div>
    <div>
        @if(isset($productions))
            {{$count}}
            <ul>
                @foreach($productions as $item)
                    <li>{{ $item->title }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
