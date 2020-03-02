@extends('layouts.app')

{{--  MODAL TITLE  --}}
@section('modalTitle', 'New Card')

{{-- MODAL ID TAG --}}
@section('modalId', 'newCardModal')

{{--  MODAL BODY  --}}
@section('modalBody')
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
@endsection

{{--  CLOSE BUTTON  --}}
@section('closeButtonModalFooter')
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
@endsection

{{--  MODAL FOOTER  --}}
@section('modalFooter')
    <button type="button" class="btn btn-primary">Save changes</button>
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
                <div class="modal-body">
                    @yield('modalBody')
                </div>
                <div class="modal-footer">
                    @yield('closeButtonModalFooter')
                    @yield('modalFooter')
                </div>
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
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('monthlyRecharge.index', ['card_id' => $card->id]) }}">Recharges</a>
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('monthlyRecharge.create',['card_id' => $card->id]) }}">Apply Recharge</a>
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('activity.index', ['card_id' => $card->id]) }}">Card Usage</a>
                        <a class="btn btn-sm btn-primary"
                            href="{{ route('activity.create',['card_id' => $card->id]) }}">Register Usage</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#@yield('modalId')">
    Launch demo modal
</button>

@yield("@yield('modalId')")

@endsection