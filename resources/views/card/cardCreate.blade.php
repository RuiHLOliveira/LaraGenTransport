@extends('layouts.app')

@section('content')
<h1>Cards</h1>

@if (session('success'))
<div class="row">
    <div class="col">
        <div class="alert alert-success">
            {{ session()->pull('success') }}
        </div>
    </div>
</div>
@endif
@if (session('error'))
<div class="row">
    <div class="col">
        <div class="alert alert-danger">
            {{ session()->pull('error') }}
        </div>
    </div>
</div>
@endif

<form action="{{ route('card.store') }}" method="POST">
    @csrf
    name:<input type="text" name="name" id="">
    acquisition date:<input type="date" name="acquisitionDate" id="">
    <input type="submit" value="send">
</form>

</div>
@endsection
