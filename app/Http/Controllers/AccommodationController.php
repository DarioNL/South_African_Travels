<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\Destination;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccommodationController extends Controller
{




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $accommodation = Accommodation::find($id);

       return view('accommodation.show', compact('accommodation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accommodation = Accommodation::find($id);

        return view('accommodation.facilities.edit', compact('accommodation'));
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
            'chambers' => 'required',
            'type' => 'required',
            'range' => 'required',
        ]);


        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'name' . $i => 'required',
            ]);
        }

        $accommodation = Accommodation::find($id);

        $accommodation->update([
            'chambers' => $request->post('chambers'),
            'type' => $request->post('type'),
            'range' => $request->post('range'),
        ]);

        $i = 0;
        foreach($accommodation->Facilities as $facility) {
            $i++;
            $facility->update([
                'name' => $request->post('name'.$i),
            ]);
        }
        if (!$accommodation->Facilities) {
            $facilities_number = 0;
        }else{
            $facilities_number = $accommodation->Facilities->count();
        }
        if ($request->post('total_items') > $facilities_number) {
            $i = 1;
            for ($i = 1; $i < $request->post('total_items') + 1; $i++)
                Facility::create([
                    'name' => $request->post('name' . $i),
                    'accommodation_id' => $id,
                ]);
        }

        return redirect('/admin/accommodaties/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $accommodation = Accommodation::find($id);

        return view('accommodation.delete', compact('accommodation'));
    }

    public function postDestroy($id)
    {
        $accommodation = Accommodation::find($id);

        foreach ($accommodation->Facilities as $facility){
            $facility->delete();
        }

        Accommodation::destroy($id);

        return redirect('/admin/bestemmingen');
    }
}
