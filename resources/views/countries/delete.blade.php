@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Verwijderen: {{$country->location}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/landen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/landen/{{$country->id}}/verwijderen" method="POST">
                    @csrf
                    <h5>Weet je zeker dat je {{$country->naam}} wilt verwijderen?</h5>
                    <div class="row pt-5">
                        <div class="col-12">
                                <button class="btn btn-danger float-right w-25">Verwijderen</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
