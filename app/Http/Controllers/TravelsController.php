<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Destination;
use App\Models\Facility;
use App\Models\Travel;
use App\Models\traveler;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TravelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travel::all();
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
            'destination_id' => 'required',

        ]);

        $destination = Destination::find($request->post('destination_id'));

        $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
        if (!Destination::all()->where('code', '=', $code)) {
            Destination::create([
                'start_date' => $request->post('start_date'),
                'end_date' => $request->post('end_date'),
                'type' => $request->post('type'),
                'destination_id' => $destination->id,
                'code' => $code,
            ]);
        }else{
            $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
            Destination::create([
                'start_date' => $request->post('start_date'),
                'end_date' => $request->post('end_date'),
                'type' => $request->post('type'),
                'destination_id' => $destination->id,
                'code' => $code,
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

       return view('travels.show', compact('travel'));
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

        return view('travels.edit', compact('travels'));
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
            'destination_id' => 'required',

        ]);

        $travel = Travel::find($id);

        $travel->update([
            'start_date' => $request->post('start_date'),
            'end_date' => $request->post('end_date'),
            'type' => $request->post('type'),
        ]);





        return redirect('/reizen/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $travel = Travel::find($id);
        $travel->destroy();

        return redirect('/Reizen');
    }
}
