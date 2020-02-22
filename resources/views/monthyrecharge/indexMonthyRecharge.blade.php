@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <h1>Recharges</h1>
        @isset($card)
            for card {{ $card->name }}
        @endisset
    </div>
</div>

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
        @isset($card)
            <a class="btn btn-primary" href="{{ route('monthlyRecharge.create', ['card_id' => $card->id]) }}">New Recharge for this</a>
        @else
            <a class="btn btn-primary" href="{{ route('monthlyRecharge.create') }}">New Recharge</a>
        @endisset
    </div>
</div>

<div class="row">
    <div class="col">
        <table class="table">
            <thead>

            </thead>
            <tbody>
            @foreach ($monthlyRecharges ?? [] as $monthlyRecharge)
                <tr>
                    <td>{{ $monthlyRecharge->card_id }}</td>
                    <td>{{ $monthlyRecharge->date }}</td>
                    <td>$ {{ $monthlyRecharge->amount }}</td>
                    <td>{{ $monthlyRecharge->monthReference }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('monthlyRecharge.create') }}">Apply Recharge</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection