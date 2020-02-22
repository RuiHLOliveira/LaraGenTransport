<?php

namespace App\Http\Controllers;

use App\MonthlyRecharge;
use App\Card;
use App\Day;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MonthlyRechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $card_id = $request->card_id;
        if($card_id != null) {
            $card = Card::find($card_id)->first();
            $monthlyRecharges = MonthlyRecharge::where('card_id', $card_id)->get();
        } else {
            $card = null;
            $monthlyRecharges = MonthlyRecharge::where('user_id', $card_id)->get();
        }
        return view('monthyrecharge.indexMonthyRecharge',compact([
            'card',
            'monthlyRecharges'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $card_id = $request->card_id;
        if($card_id != null) {
            $chosenCard = Card::find($card_id)->first();
            $cards = null;
        } else {
            $chosenCard = null;
            $cards = Card::where('user_id', $user->id)->get();
        }
        return view('monthyrecharge.createMonthyRecharge',compact([
            'chosenCard',
            'cards'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $monthlyRecharge = new MonthlyRecharge();
        $monthlyRecharge->amount = str_replace(',', '.', $request->amount);
        $monthlyRecharge->date = $request->date;
        $monthlyRecharge->monthReference = $request->monthReference;
        $monthlyRecharge->user_id = Auth::user()->id;
        $monthlyRecharge->card_id = $request->card_id;
        $monthlyRecharge->save();

        //create days
        $referenceDate = Carbon::createFromFormat('Y-m-d', $request->monthReference);
        $month = $referenceDate->format('m');
        $year = $referenceDate->format('Y');

        // list all days of the month
        $dayList = [];
        for($d=1; $d<=31; $d++)
        {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                $dayList[]=date('Y-m-d', $time);
        }

        foreach ($dayList as $key => $date) {
            $day = new Day();
            $day->avaliableAmount = 0;
            $day->date = $date;
            $day->user_id = Auth::user()->id;
            $day->monthly_recharge_id = $monthlyRecharge->id;
            $day->save();
        }

        session(['success' => 'Card successfuly recharged']);
        return redirect()->route('card.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MonthlyRecharge  $monthlyRecharge
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyRecharge $monthlyRecharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MonthlyRecharge  $monthlyRecharge
     * @return \Illuminate\Http\Response
     */
    public function edit(MonthlyRecharge $monthlyRecharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MonthlyRecharge  $monthlyRecharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyRecharge $monthlyRecharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MonthlyRecharge  $monthlyRecharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyRecharge $monthlyRecharge)
    {
        //
    }
}
