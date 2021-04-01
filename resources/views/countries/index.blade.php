@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Landen</h3>
            </div>
            @auth('admin')
            <div class="float-right">
                <a type="button" class="btn btn-primary" href="/admin/landen/toevoegen">
                    + Voeg Nieuw Land Toe
                </a>
            </div>
            @endauth
        </div>
        <div class="card-body w-100 pt-2">

            <table id="datatable" class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Naam</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr class="clickable-row" data-href="/admin/landen/{{$country->id}}">
                        <td>
                            {{$country->code}}
                        </td>
                        <td>
                            {{$country->name}}
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
