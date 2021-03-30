@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Travels</h3>
            </div>
            @auth('admin')
            <div class="float-right">
                <a type="button" class="btn btn-primary" href="/admin/reizen/toevoegen">
                    + Voeg Nieuwe reizen Toe
                </a>
            </div>
            @endauth
        </div>
        <div class="card-body w-100 pt-2">

            <table id="datatable" class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Start Datum</th>
                    <th>Eind Datum</th>
                    <th>type</th>
                    <th>bestemming</th>
                    <th>provincie</th>
                    <th>land</th>
                    <th>Prijs</th>
                </tr>
                </thead>
                <tbody>
                @foreach($travels as $travel)
                    <tr class="clickable-row" data-href="/reizen/{{$travel->id}}">
                        <td>
                            {{$travel->code}}
                        </td>
                        <td>
                            {{$travel->start_date}}
                        </td>
                        <td>
                            {{$travel->end_date}}
                        </td>
                        <td>
                            {{$travel->type}}
                        </td>
                        <td>
                            {{$travel->Destination->location}}
                        </td>
                        <td>
                            {{$travel->Destination->province}}
                        </td>
                        <td>
                            {{$travel->Destination->country}}
                        </td>
                        <td>
                            {{$travel->price}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
