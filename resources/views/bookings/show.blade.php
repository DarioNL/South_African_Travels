@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">

                <h3 class="float-left">Boeking: {{$booking->travel->code}}</h3>
                <div class="float-right">
                    @auth('admin')
                        @if($booking->is_payed)
                            <a type="button" class="btn btn-danger" href="/admin/boekingen/{{$booking->id}}/betaald/annuleer">
                                Markeer als niet betaald
                            </a>
                        @else
                            <a type="button" class="btn btn-primary" href="/admin/boekingen/{{$booking->id}}/betaald">
                                Markeer als betaald
                            </a>
                        @endif
                    @endauth
                    <a type="button" class="btn btn-danger" href="/boekingen/{{$booking->id}}/annuleer">
                        annuleer
                    </a>
                </div>
            </div>
            <h4 class="float-right text-muted mr-2 mt-1">
                <a href="/bookingen" class="text-muted">< terug</a>
            </h4>
            <div class="card-text">
                <table class="table border" style="width:100%">
                    <tr>
                        <th>start datum:</th>
                        <td class="border-left w-75">{{$booking->travel->start_date}}</td>
                    </tr>
                    <tr>
                        <th>eind datum:</th>
                        <td class="border-left">{{$booking->travel->end_date}}</td>
                    </tr>
                    <tr>
                        <th>betaald:</th>
                        <td class="border-left @if($booking->is_payed) text-success @else text-danger @endif"> @if($booking->is_payed) betaald @else niet betaald @endif</td>
                    </tr>
                    @auth('admin')
                        <th>klant:</th>
                        <td class="border-left">{{$booking->user->first_name}} {{$booking->user->last_name}}</td>
                    @endauth
                </table>

            </div>

            <div>
                <h4>In {{$booking->travel->destination->location}} @if($booking->travel->destination->Accommodations->count() > 1 or $booking->travel->destination->Accommodations->count() == 0) zijn @else is @endif {{$booking->travel->destination->Accommodations->count()}} @if($booking->travel->destination->Accommodations->count() > 1 or $booking->travel->destination->Accommodations->count() == 0) accommodaties. @else acocomodatie. @endif</h4>
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
                @foreach($booking->travel->destination->Accommodations as $accommodation)
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

            <div>
                <h4>Er @if($booking->travelers->count() > 1 or $booking->travelers->count() == 0) gaan @else gaat @endif {{$booking->travelers->count()}} @if($booking->travelers->count() > 1 or $booking->travelers->count() == 0) klanten @else klant @endif mee. </h4>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>voornaam</th>
                    <th>achternaam</th>
                </tr>
                </thead>
                <tbody>
                @foreach($booking->travelers as $traveler)
                    <tr>
                        <td>
                            {{$traveler->first_name}}
                        </td>
                        <td>
                            {{$traveler->last_name}}
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

