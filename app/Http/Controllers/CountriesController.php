<?php

namespace App\Http\Controllers;

use App\Models\countries;
use App\Models\country;
use App\Models\Province;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('countries.create');
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
            'name' => 'required',
            'code' => 'required',
            'total_items' => 'required',

        ]);


        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'province_name' . $i => 'required',
            ]);
        }



        if ($request->file('flag')) {
            $logoUpload = $request->file('flag');
            $logoName = time() . '.' . $logoUpload->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logoUpload->move($logoPath, $logoName);
        }



        $country = Country::create([
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'flag' => 'images/'.$logoName,
        ]);

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {
            Province::create([
                'name' => $request->post('province_name'.$i),
                'country_id' => $country->id,
            ]);
        }




        return redirect('admin/landen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);

        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);

        return view('countries.edit', compact('country'));
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
            'name' => 'required',
            'code' => 'required',
            'total_items' => 'required',

        ]);

        $country = Country::find($id);

        if ($request->file('flag')) {
            $logoUpload = $request->file('flag');
            $logoName = time() . '.' . $logoUpload->getClientOriginalExtension();
            $logoPath = public_path('/images/');
            $logoUpload->move($logoPath, $logoName);
        }

        $country->update([
            'name' => $request->post('name'),
            'code' => $request->post('code'),
            'flag' => 'images/'.$logoName,
        ]);

        for ($i = 1; $i < $request->post('total_items')+1; $i++) {

            $request->validate([
                'province_name' . $i => 'required',
            ]);

            if ($country->Provinces->count()) {
                $i = 1;
            }else{
                $i = 0;
            }
            for ($i=$i; $i < $request->post('total_items');) {
                $i++;
                Province::create([
                    'name' => $request->post('province_name'),
                    'country-id' => $country->name,
                ]);
            }
        }



        return redirect('admin/landen/'.$id);
    }

    public function destroy($id)
    {
        $country = country::find($id);

        return view('countries.delete', compact('country'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postDestroy($id)
    {
        $country = country::find($id);

        foreach ($country->Provinces as $province){
            $province->delete();
        }

        $country->delete();

        return redirect('admin/landen');
    }
}
