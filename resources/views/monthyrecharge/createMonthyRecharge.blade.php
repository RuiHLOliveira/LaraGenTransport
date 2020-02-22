@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <h1>New Recharge</h1>
        @isset($chosenCard)
            for card {{ $chosenCard->name }}
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
        <form action="{{ route('monthlyRecharge.store') }}" method="POST">
            @csrf
            <div class="form-group">

                <div class="row">
                    <div class="col">
                        <label for="card_id">Select a card</label>
                        <select name="card_id" class="form-control" id='card_id'>
                            @if (isset($cards))
                                @foreach ($cards ?? [] as $card)
                                    <option value="{{ $card->id }}">{{ $card->name }}</option>
                                @endforeach
                            @else
                                <option value="{{ $chosenCard->id }}">{{ $chosenCard->name }}</option>
                            @endif
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col">
                        <label for="amount">Amount</label>
                        <input class="form-control" type="text" name="amount" id="amount">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="date">Date</label>
                        <input class="form-control" type="date" name="date" id="date">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="monthReference">First day of reference month</label>
                        <input class="form-control" type="date" name="monthReference" id="monthReference">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <input class="form-control" type="submit" value="Send">
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection