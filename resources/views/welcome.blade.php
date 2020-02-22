@extends('layouts.app')

@section('content')
    <h1>Welcome to {{ config('app.name') }}!</h1>
    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
</div>
@endsection
