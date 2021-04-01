@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Bestemmingen</h3>
            </div>
            @auth('admin')
            <div class="float-right">
                <a type="button" class="btn btn-primary" href="/admin/bestemmingen/toevoegen">
                    + Voeg Nieuwe Bestemmingen Toe
                </a>
            </div>
            @endauth
        </div>
        <div class="card-body w-100 pt-2">

            <table id="datatable" class="table">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Plaats</th>
                    <th>Land</th>
                    <th>Provincie</th>
                </tr>
                </thead>
                <tbody>
                @foreach($destinations as $destination)
                    <tr class="clickable-row" data-href="/admin/bestemmingen/{{$destination->id}}">
                        <td>
                            {{$destination->code}}
                        </td>
                        <td>
                            {{$destination->location}}
                        </td>
                        <td>
                            {{$destination->Province->Country->name}}
                        </td>
                        <td>
                            {{$destination->Province->name}}
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
