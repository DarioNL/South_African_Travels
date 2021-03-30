@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Markeren als niet Betaald: {{$booking->travel->code}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/boekingen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/boekingen/{{$booking->id}}/betaald/annuleer" method="POST">
                    @csrf
                    <h5>Weet je zeker dat je {{$booking->travel->code}} wilt markeren als niet betaald?</h5>
                    <div class="row pt-5">
                        <div class="col-12">
                                <button class="btn btn-danger float-right w-25">Markeren Als Niet Betaald</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
