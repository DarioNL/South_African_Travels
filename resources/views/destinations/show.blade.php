@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Bestemming: {{$destination->code}}</h3>
                <div class="float-right">
                    <a type="button" class="btn btn-primary" href="/admin/bestemmingen/{{$destination->id}}/bijwerken">
                        Wijzigen
                    </a>

                    <a type="button" class="btn btn-danger" href="/admin/bestemmingen/{{$destination->id}}/verwijderen">
                        Verwijderen
                    </a>
                </div>
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/admin/bestemmingen" class="text-muted">< terug</a>
            </h4>
            <div class="card-text">
                <table class="table border" style="width:100%">
                    <tr>
                        <th>locatie:</th>
                        <td class="border-left w-75">{{$destination->location}}</td>
                    </tr>
                    <tr>
                        <th>land:</th>
                        <td class="border-left">{{$destination->Province->name}}</td>
                    </tr>
                    <tr>
                        <th>provincie:</th>
                        <td class="border-left">{{$destination->Province->Country->name}}</td>
                    </tr>
                </table>

            </div>

            <div>
                <h4>In {{$destination->location}} @if($destination->Accommodations->count() > 1 or $destination->Accommodations->count() == 0) zijn @else is @endif {{$destination->Accommodations->count()}} @if($destination->Accommodations->count() > 1 or $destination->Accommodations->count() == 0) accommodaties. @else acocomodatie. @endif</h4>
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
                @foreach($destination->accommodations as $accommodation)
                    <tr class="clickable-row" data-href="/admin/accommodaties/{{$accommodation->id}}">
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
