@extends('layouts.app')

@section('title', 'Find Movies')

@section('content')
    <div class="step">
        Find movies/shows made in ABQ
    </div>
    <form method="POST" action="/show">
        @csrf
        <div class="input-group">
            <label for="start_date">Start Date</label>
            <input name="start_date" type="date" class="@error('start_date') is-invalid @enderror">
            @error('start_date')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-group">
            <label for="end_date">End Date</label>
            <input name="end_date" type="date" class="@error('end_date') is-invalid @enderror">
            @error('end_date')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" name="tz" id="tz">
        <input type="submit" value="Find Movies" class="button"/>
    </form>
@endsection
@push('js')
    <script>

            document.getElementById('tz').val(moment.tz.guess())
        
    </script>
@endpush
