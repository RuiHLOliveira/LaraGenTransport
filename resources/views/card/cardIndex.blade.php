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

<div class="row">
    <div class="col">
        <a class="btn btn-primary" href="{{ route('card.create') }}">New Card</a>
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <th>Card Name</th>
                <th>Acquisition date</th>
                <th>Actions</th>
            </thead>
            <tbody>
            @foreach ($cards ?? [] as $card)
                <tr>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->acquisitionDate }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('monthlyRecharge.index', ['card_id' => $card->id]) }}">Recharges</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('monthlyRecharge.create',['card_id' => $card->id]) }}">Apply Recharge</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('activity.index', ['card_id' => $card->id]) }}">Card Usage</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('activity.create',['card_id' => $card->id]) }}">Register Usage</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
