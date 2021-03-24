@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Bijwerken: {{$accommodation->code}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/admin/accommodaties/{{$accommodation->id}}" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/accommodaties/{{$accommodation->id}}/wijzigen" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <label for="" class="font-weight-bolder text-muted col-form-label">{{__('Soort')}}</label>
                            <input type="text" autocomplete="type"
                                   class="form-control  @error('type') is-invalid @enderror"
                                   name="type" value="{{$accommodation->type}}"
                                   required autofocus>


                            @error('type')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="chambers" class="font-weight-bolder text-muted col-form-label">{{__('Aantal Kamers')}}</label>
                                <input type="number" min="1" autocomplete="chambers"
                                       class="form-control  @error('chambers') is-invalid @enderror"
                                       name="chambers" value="{{$accommodation->chambers}}"
                                       required autofocus>


                                @error('chambers')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="range" class="font-weight-bolder text-muted col-form-label">{{__('Ligging')}}</label>
                                <input type="text" autocomplete="range"
                                       class="form-control  @error('range') is-invalid @enderror"
                                       name="range" value="{{$accommodation->range}}"
                                       required autofocus>


                                @error('range')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <div class="row pt-3">
                        <div class="col-12">
                            <a class="new-accommodation" href="#">+ Voeg Een Nieuwe Faciliteit Toe</a>
                            <table class=" border-bottom border-top order-table w-100">
                                <tr class="border-bottom text-secondary order-table-header" style="box-shadow: none !important; font-weight: normal">
                                    <th class="order">Naam</th>
                                </tr>
                                <tbody class="product" id="order-table">
                                @php($i = 0)
                                @php($accommodations = $accommodation->facilities->count())
                                @if($accommodations = 0)
                                    <tr id="table-rows">
                                        <th scope="row">
                                            <input id="name1" type="text" autocomplete="name1"
                                                   class="form-control product copy"
                                                   name="name1" value="{{old('facility1')}}"
                                                   required autofocus>
                                        </th>
                                    </tr>
                                @endif

                                    @foreach($accommodation->Facilities as $facility)
                                        @php($i++)
                                        <tr id="table-rows">
                                            <th scope="row">
                                                <input id="name{{$i}}" type="text" autocomplete="name{{$i}}"
                                                       class="form-control product copy"
                                                       name="name{{$i}}" value="{{$facility->name}}"
                                                       required autofocus>
                                            </th>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="total_items" id="total_items" value="{{$i}}">
                    <div class="row pt-5">
                        <div class="col-12">
                                <button class="btn btn-primary float-right w-25">Bijwerken</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
