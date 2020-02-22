<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Card;
use App\Day;
use App\MonthlyRecharge;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //fazer a lista dado card_id
        $activities = Activity::where([
            ['card_id', '=', $request->card_id]
        ])->get();
        return view('activity.activityIndex',compact([
            'activities'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $card = Card::find($request->card_id);
        return view('activity.activityCreate',compact([
            'card'
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
        // $table->text('transport');
        // $table->text('way');
        // $table->date('date');
        // $table->float('amount');
        // $table->unsignedBigInteger('user_id');
        // $table->unsignedBigInteger('day_id');
        
        //com o card_id e o month do date
        //se acha o monthlyRecharge e o dia.

        //preciso do day->id
        //para pegar o day, é só ver o day cuja date seja == a date inputada
        //day = where monthlyRecharge = 1 e date = date inputada.
        //monthlyrecharge = where card_id = 1 e date = startofmonth(date inputada)
        

        $firstOfMonth = Carbon::createFromFormat('Y-m-d', $request->date);
        $firstOfMonth = $firstOfMonth->firstOfMonth()->format('Y-m-d');

        $monthlyRecharge = MonthlyRecharge::where([
            ['card_id', '=', $request->card_id],
            ['monthReference', '=', $firstOfMonth]
        ])->first();

        $day = Day::where([
            ['monthly_recharge_id', '=', $monthlyRecharge->id],
            ['date', '=', $request->date],
        ])->first();

        $activity = new Activity();
        $activity->transport = $request->transport;
        $activity->way = $request->way;
        $activity->date = $request->date;
        $activity->amount = str_replace(',', '.', $request->amount);
        $activity->user_id = Auth::user()->id;
        $activity->day_id = $day->id;
        $activity->card_id = $request->card_id;
        $activity->save();
        
        return redirect()->route('activity.index',['card_id' => $request->card_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
