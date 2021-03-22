@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Reis: {{$travel->code}}</h3>
                @auth('admin')
                <div class="float-right">
                    <a type="button" class="btn btn-primary" href="/reizen/{{$travel->id}}/bijwerken">
                        Wijzigen
                    </a>

                    <a type="button" class="btn btn-danger" href="/reizen/{{$travel->id}}/verwijderen">
                        Verwijderen
                    </a>
                </div>
                @else
                    <a type="button" class="btn btn-primary" href="/reizen/{{$travel->id}}/boeken">
                        Boeken
                    </a>
                @endauth
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/reizen" class="text-muted">< terug</a>
            </h4>
            <div class="card-text">
                <table class="table border" style="width:100%">
                    <tr>
                        <th>Start Datum:</th>
                        <td class="border-left w-75">{{$travel->start_date}}</td>
                    </tr>
                    <tr>
                        <th>Eind Datum:</th>
                        <td class="border-left">{{$travel->end_date}}</td>
                    </tr>
                    <tr>
                        <th>type:</th>
                        <td class="border-left">{{$travel->type}}</td>
                    </tr>
                    <tr>
                        <th>bestemming:</th>
                        <td class="border-left">{{$travel->Destination->location}}</td>
                    </tr>
                </table>

            </div>

    </div>

        @endsection



