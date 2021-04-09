<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Country;
use App\Models\Destination;
use App\Models\Facility;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();

        return view('destinations.create', compact('countries'));
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
            'location' => 'required',
            'province' => 'required',
            'code' => [
                Rule::unique('destinations','code'),
                Rule::unique('travels','code'),
            ],
        ]);




        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'type' . $i => 'required',
                'chambers' . $i => 'required',
                'range' . $i => 'required',
            ]);
        }

        if ($request->file('photo')) {
            $logoUpload = $request->file('photo');
            $logoName = time() . '.' . $logoUpload->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logoUpload->move($logoPath, $logoName);
        }

        $destination = Destination::create([
            'location' => $request->post('location'),
            'province_id' => $request->post('province'),
            'code' => $request->post('code'),
            'photo' => 'images/'.$logoName,
        ]);

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
            if (!Accommodation::all()->where('code', '=', $code)) {
                Accommodation::create([
                    'code' => $code,
                    'type' => $request->post('type' . $i),
                    'chambers' => $request->post('chambers' . $i),
                    'range' => $request->post('range' . $i),
                    'destination_id' => $destination->id,
                ]);
            }else{
                $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
                Accommodation::create([
                    'code' => $code,
                    'type' => $request->post('type' . $i),
                    'chambers' => $request->post('chambers' . $i),
                    'range' => $request->post('range' . $i),
                    'destination_id' => $destination->id,
                ]);
            }
            }

        return redirect('/admin/bestemmingen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $destination = Destination::find($id);

       return view('destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::find($id);
        $countries = Country::all();

        return view('destinations.edit', compact('destination', 'countries'));
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
            'location' => 'required',
            'province' => 'required',
        ]);


        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'type' . $i => 'required',
                'chambers' . $i => 'required',
                'range' . $i => 'required',
            ]);
        }

        $destination = Destination::find($id);

        if ($request->file('photo')) {
            $logoUpload = $request->file('photo');
            $logoName = time() . '.' . $logoUpload->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logoUpload->move($logoPath, $logoName);
        }

        $destination->update([
            'location' => $request->post('location'),
            'province_id' => $request->post('province'),
            'photo' => 'images'.$logoName,
        ]);

        if ($request->post('total_items') > $destination->accommodations->count()) {
            if ($destination->accommodations->count()) {
                $i = 1;
            }else{
                $i = 0;
            }
            $code = $destination->code.random_int(0,9).random_int(0,9).random_int(0,9).random_int(0,9);
            for ($i=$i; $i < $request->post('total_items');) {
                $i++;
                Accommodation::create([
                    'destination_id' => $id,
                    'code' => $code,
                    'type' => $request->post('type' . $i),
                    'chambers' => $request->post('chambers' . $i),
                    'range' => $request->post('range' . $i),
                ]);
            }
        }

        $i = 0;
        foreach($destination->accommodations as $accommodation) {
            $i++;
            $accommodation->update([
                'type' => $request->post('type'.$i),
                'chambers' => $request->post('chambers'.$i),
                'range' => $request->post('range'.$i),
            ]);
        }




        return redirect('/admin/bestemmingen/'.$id);
    }

    public function destroy($id)
    {
        $destination = Destination::find($id);

        return view('destinations.delete', compact('destination'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDestroy($id)
    {
        $destination = Destination::find($id);

        Foreach($destination->Travels as $travel){
            $travel->delete();
        }

        $destination->delete();

        return redirect('admin/bestemmingen');
    }
}
