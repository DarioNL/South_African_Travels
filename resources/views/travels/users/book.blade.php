@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Reis Boeken: {{$travel->code}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/admin/reizen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/reizen/{{$travel->id}}/boeken" method="POST">
                    @csrf


                    <div class="row pt-3">
                        <div class="col-12">
                            <a class="new-traveler" href="#">+ Voeg Een Nieuwe Klant Toe</a>
                            <table class=" border-bottom border-top order-table w-100">
                                <tr class="border-bottom text-secondary order-table-header" style="box-shadow: none !important; font-weight: normal">
                                    <th class="order">Voornaam</th>
                                    <th class="order">Achternaam</th>
                                </tr>
                                <tbody class="product" id="order-table">
                                <tr id="table-rows">
                                    <th scope="row">
                                        <input id="first_name1" type="text" autocomplete="first_name1"
                                               class="form-control product copy"
                                               name="first_name1" value="{{\Illuminate\Support\Facades\Auth::user()->first_name}}"
                                               required autofocus>
                                    </th>
                                    <td>
                                        <input type="text" autocomplete="last_name1"
                                               class="form-control copy"
                                               name="last_name1" value="{{\Illuminate\Support\Facades\Auth::user()->last_name}}"
                                               required autofocus>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="total_travelers" id="total_travelers" max="{{$travel->Destination->Accommodations->sum('chambers')}}" value="1">
                    <input type="hidden" name="max_travelers" id="max_travelers" max="{{$travel->Destination->Accommodations->sum('chambers')}}" value="{{$travel->Destination->Accommodations->sum('chambers')}}" min="{{$travel->Destination->Accommodations->sum('chambers')}}" readonly>
                    <div class="row pt-5">
                        <div class="col-12">
                                <button class="btn btn-primary float-right w-25">Toevoegen</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
