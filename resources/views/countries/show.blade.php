@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Land: {{$country->code}}</h3>
                <div class="float-right">
                    <a type="button" class="btn btn-primary" href="/admin/landen/{{$country->id}}/bijwerken">
                        Wijzigen
                    </a>

                    <a type="button" class="btn btn-danger" href="/admin/landen/{{$country->id}}/verwijderen">
                        Verwijderen
                    </a>
                </div>
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/admin/landen" class="text-muted">< terug</a>
            </h4>
            <div class="card-text">
                <table class="table border" style="width:100%">
                    <tr>
                        <th>Naam:</th>
                        <td class="border-left w-75">{{$country->name}}</td>
                    </tr>
                </table>

            </div>

            <div>
                <h4>In {{$country->name}} @if($country->Provinces->count() > 1 or $country->Provinces->count() == 0) zijn @else is @endif {{$country->Provinces->count()}} @if($country->Provinces->count() > 1 or $country->Provinces->count() == 0) provincies. @else provincie. @endif</h4>
            </div>

            <table id="datatable" class="table">
                <thead>
                <tr>
                    <th>Naam</th>
                </tr>
                </thead>
                <tbody>
                @foreach($country->provinces as $province)
                    <tr class="clickable-row" data-href="/admin/province/{{$province->id}}">
                        <td>
                            {{$province->name}}
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

