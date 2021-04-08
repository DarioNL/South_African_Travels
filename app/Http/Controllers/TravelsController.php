<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Facility;
use App\Models\Travel;
use App\Models\traveler;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\If_;

class TravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::all()->where('is_booked', '=', 0);
        return view('travels.index', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travels.create');
    }

    public function notLoggedIn()
    {
        return redirect('/login');
    }



    public function book($id){
        $travel = Travel::find($id);

        if ($travel->is_booked == 0) {
            return view('travels.users.book', compact('travel'));
        }else{
            return redirect('/reizen');
        }
    }

    public function postBook(Request $request, $id){
        $request->validate([
           'total_travelers' => 'required',
        ]);


        $travel = Travel::find($id);

        if($request->post('total_travelers') <= $travel->Destination->Accommodations->sum('chambers')) {
            for ($i = 1; $i < $request->post('total_travelers') + 1; $i++) {

                $request->validate([
                    'first_name' . $i => 'required',
                    'last_name' . $i => 'required',
                ]);
            }


            $booking = Booking::create([
                'date' => Carbon::now(),
                'user_id' => Auth::id(),
                'travel_id' => $travel->id,
                'price' => $travel->price,
            ]);

            for ($i = 1; $i < $request->post('total_travelers') + 1; $i++)
                traveler::create([
                    'first_name' => $request->post('first_name' . $i),
                    'last_name' => $request->post('last_name' . $i),
                    'booking_id' => $booking->id,
                ]);

            $travel->is_booked = 1;
            $travel->save();

            return redirect('/boekingen');
        }else{
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'destination' => 'required',
            'price' => 'required'

        ]);

        $destination = Destination::find($request->post('destination'));


        $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
        if (!Destination::all()->where('code', '=', $code)) {
            Travel::create([
                'start_date' => $request->post('start_date'),
                'end_date' => $request->post('end_date'),
                'type' => $request->post('type'),
                'destination_id' => $destination->id,
                'code' => $code,
                'price' => $request->post('price')
            ]);
        }else{
            $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
            Travel::create([
                'start_date' => $request->post('start_date'),
                'end_date' => $request->post('end_date'),
                'type' => $request->post('type'),
                'destination_id' => $destination->id,
                'code' => $code,
                'price' => $request->post('price')
            ]);
        }





        return redirect('/reizen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $travel = Travel::find($id);

       $max_travelers = $travel->Destination->Accommodations->sum('chambers');

       return view('travels.show', compact('travel', 'max_travelers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $travel = Travel::find($id);

        return view('travels.edit', compact('travel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'destination' => 'required',
            'price' => 'required',

        ]);

        $travel = Travel::find($id);

        $travel->update([
            'start_date' => $request->post('start_date'),
            'end_date' => $request->post('end_date'),
            'type' => $request->post('type'),
            'destination' => $request->post('destination'),
            'price' => $request->post('price'),
        ]);





        return redirect('/reizen/'.$id);
    }

    public function destroy($id)
    {
        $travel = Travel::find($id);

        return view('travels.delete', compact('travel'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDestroy($id)
    {
        $travel = Travel::find($id);
        $travel->delete();

        return redirect('/reizen');
    }
}
