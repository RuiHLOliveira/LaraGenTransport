@extends('layouts.app')

@section('content')
<h1>Activities</h1>
    
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

<div class="row">
    <div class="col">
        <a disabled class="btn btn-primary" href="{{ route('card.create') }}">New Card</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Transport</th>
                <th>Way</th>
                <th>Amount</th>
            </thead>
            <tbody>
                @foreach ($activities ?? [] as $activitiy)
                <tr>
                    <td>{{ $activitiy->date }}</td>
                    <td>{{ $activitiy->transport }}</td>
                    <td>{{ $activitiy->way }}</td>
                    <td>$ {{ $activitiy->amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
