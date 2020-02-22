@extends('layouts.app')

@section('content')
<h1>Activity</h1>

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

<form action="{{ route('activity.store', ['card_id' => $card->id]) }}" method="POST">
    @csrf
    <div class="form-group">

        <div class="row">
            <div class="col">
                <label for="transport">Transport</label>
                <input class="form-control" type="text" name="transport" id="transport">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="way">Way</label>
                <input class="form-control" type="text" name="way" id="way">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="date">date</label>
                <input class="form-control" type="date" name="date" id="date">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="amount">amount</label>
                <input class="form-control" type="text" name="amount" id="amount">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input class="form-control" type="submit" value="send">
            </div>
        </div>
        
    </div>
</form>

</div>
@endsection