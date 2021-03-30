@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')

    <div class="card table-container align-items-center w-100">
        <div class="w-100 border-bottom p-2">
            <div class="float-left">
                <h3 class="float-left pt-2">Boekingen</h3>
            </div>
        </div>
        <div class="card-body w-100 pt-2">

            <table id="datatable" class="table">
                <thead>
                <tr>
                    <th>Reis</th>
                    <th>Start datum</th>
                    <th>eind datum</th>
                    <th>Betaald</th>
                    @auth('admin')
                        <th>Klant</th>
                    @endauth
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr class="clickable-row" data-href="/boekingen/{{$booking->id}}">
                        <td>
                            {{$booking->travel->code}}
                        </td>
                        <td>
                            {{$booking->travel->start_date}}
                        </td>
                        <td>
                            {{$booking->travel->end_date}}
                        </td>
                        <td @if($booking->is_payed) class="text-success" @else class="text-danger" @endif>
                            @if($booking->is_payed) Betaald @else Niet Betaald @endif
                        </td>
                        @auth('admin')
                            <th>
                                {{$booking->user->first_name}} {{$booking->user->last_name}}
                            </th>
                        @endauth
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
