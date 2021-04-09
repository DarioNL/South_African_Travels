@extends('layouts.app')


@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Accommodatie: {{$accommodation->code}}</h3>
                @auth('admin')
                    <div class="float-right">
                        <a type="button" class="btn btn-primary" href="/admin/accommodaties/{{$accommodation->id}}/bijwerken">
                            Wijzigen
                        </a>

                        <a type="button" class="btn btn-danger" href="/admin/accommodaties/{{$accommodation->id}}/verwijderen">
                            Verwijderen
                        </a>
                    </div>
                @endauth
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/admin/bestemmingen/{{$accommodation->Destination->id}}" class="text-muted">< terug</a>
            </h4>
            <div class="text-center mb-4">@if($accommodation->photo) <img src="{{asset($accommodation->photo)}}" class="" alt="Foto van de accommodatie" > @endif</div>
            <div class="card-text">
                <table class="table border" style="width:100%">
                    <tr>
                        <th>Aantal Kamers:</th>
                        <td class="border-left w-75">{{$accommodation->chambers}}</td>
                    </tr>
                    <tr>
                        <th>Soort:</th>
                        <td class="border-left">{{$accommodation->type}}</td>
                    </tr>
                    <tr>
                        <th>Ligging:</th>
                        <td class="border-left">{{$accommodation->range}}</td>
                    </tr>
                    <tr>
                        <th>Faciliteiten:</th>
                        <td class="border-left">@if($accommodation->Facilities) @foreach($accommodation->Facilities as $facility) {{$facility->name}}, @endforeach @else geen @endif</td>
                    </tr>
                </table>

            </div>



        </div>
    </div>

@endsection


