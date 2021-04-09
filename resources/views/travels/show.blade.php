@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Reis: {{$travel->code}}</h3>
                @auth('admin')
                <div class="float-right">
                    <a type="button" class="btn btn-primary" href="/admin/reizen/{{$travel->id}}/bijwerken">
                        Wijzigen
                    </a>

                    <a type="button" class="btn btn-danger" href="/admin/reizen/{{$travel->id}}/verwijderen">
                        Verwijderen
                    </a>
                </div>
                @else
                    <div class="float-right">
                    <a type="button" class="btn btn-primary" href="/reizen/{{$travel->id}}/boeken">
                        Boeken
                    </a>
                    </div>
                @endauth
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/reizen" class="text-muted">< terug</a>
            </h4>

            <div class="text-center mb-4"> @if($travel->destination->photo) <img src="{{asset($travel->destination->photo)}}" class="" alt="Foto van de Locatie" > @endif </div>
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
                    <tr>
                        <th>prijs:</th>
                        <td class="border-left">{{$travel->price}}</td>
                    </tr>
                    <tr>
                        <th>maximum aantal reizigers:</th>
                        <td class="border-left">{{$max_travelers}}</td>
                    </tr>
                </table>

                <div>
                    <h4>In {{$travel->Destination->location}} @if($travel->Destination->Accommodations->count() > 1 or $travel->Destination->Accommodations->count() == 0) zijn @else is @endif {{$travel->Destination->Accommodations->count()}} @if($travel->Destination->Accommodations->count() > 1 or $travel->Destination->Accommodations->count() == 0) accommodaties. @else acocomodatie. @endif</h4>
                </div>

                <table id="datatable" class="table">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Soort</th>
                        <th>aantal kamers</th>
                        <th>ligging</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($travel->Destination->accommodations as $accommodation)
                        <tr class="clickable-row" data-href="/accommodaties/{{$accommodation->id}}">
                            <td>
                                {{$accommodation->code}}
                            </td>
                            <td>
                                {{$accommodation->type}}
                            </td>
                            <td>
                                {{$accommodation->chambers}}
                            </td>
                            <td>
                                {{$accommodation->range}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>




        @endsection

        @section('javascripts')
            <script type="text/javascript" defer charset="utf8"
                    src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
            <script>
                $(document).ready(function () {
                    $('#datatable').DataTable({
                        "lengthChange": false
                    });
                });
            </script>
@endsection



