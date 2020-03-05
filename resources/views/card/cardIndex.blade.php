@extends('layouts.app')

{{--  MODAL TITLE  --}}
@section('modalTitle', 'New Card')

{{-- MODAL ID TAG --}}
@section('modalId', 'newCardModal')

{{--  MODAL BODY  --}}
@section('modalBody')
<div class="modal-body">
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
    <form action="{{ route('card.store') }}" method="POST" id="formNewCard">
        @csrf
        name:<input type="text" name="name" id="">
        acquisition date:<input type="date" name="acquisitionDate" id="">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type="submit"  class="btn btn-default" form="formNewCard" value="Save">
</div>
@endsection



@section("@yield('modalId')")
    <div class="modal fade" id="@yield('modalId')" tabindex="-1" role="dialog"
        aria-labelledby="@yield('modalId')Title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="@yield('modalId')Title">
                        @yield('modalTitle')
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                    @yield('modalBody')
                
            </div>
        </div>
    </div>
@endsection






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
        {{-- <a class="btn btn-default" href="{{ route('card.create') }}">New Card</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#@yield('modalId')">
            New Card
        </button>
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
                        <a class="btn btn-sm btn-default"
                            href="{{ route('monthlyRecharge.index', ['card_id' => $card->id]) }}">Recharges</a>
                        <a class="btn btn-sm btn-default"
                            href="{{ route('monthlyRecharge.create',['card_id' => $card->id]) }}">Apply Recharge</a>
                        <a class="btn btn-sm btn-default"
                            href="{{ route('activity.index', ['card_id' => $card->id]) }}">Card Usage</a>
                        <a class="btn btn-sm btn-default"
                            href="{{ route('activity.create',['card_id' => $card->id]) }}">Register Usage</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@yield("@yield('modalId')")

@endsection