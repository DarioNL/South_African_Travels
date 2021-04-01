@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Bijwerken: {{$country->code}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/admin/landen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/landen/{{$country->id}}/wijzigen" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <label for="" class="font-weight-bolder text-muted col-form-label">{{__('code')}}</label>
                            <input type="text" autocomplete="code"
                                   class="form-control  @error('code') is-invalid @enderror"
                                   name="code" value="{{$country->code}}"
                                   required autofocus>


                            @error('code')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                            <div class="col-md-6">
                                <label for="name" class="font-weight-bolder text-muted col-form-label">{{__('Naam')}}</label>
                                <input type="text" autocomplete="name"
                                       class="form-control  @error('name') is-invalid @enderror"
                                       name="name" value="{{$country->name}}"
                                       required autofocus>


                                @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="col-12">
                            <a class="new-accommodation" href="#">+ Voeg Een Nieuwe Provincie Toe</a>
                            <table class=" border-bottom border-top order-table w-100">
                                <tr class="border-bottom text-secondary order-table-header" style="box-shadow: none !important; font-weight: normal">
                                    <th class="order">Naam</th>
                                </tr>
                                <tbody class="product" id="order-table">
                                @php($i = 0)
                                @php($provinces = $country->Provinces->count())
                                @if($provinces == 0)
                                    @php($i = 1)
                                    <tr id="table-rows">
                                        <th scope="row">
                                            <input id="province_name1" type="text" autocomplete="province_name1"
                                                   class="form-control product copy"
                                                   name="province_name1" value="{{old('province_name1')}}"
                                                   required autofocus>
                                        </th>
                                    </tr>
                                @endif
                                @foreach($country->Provinces as $province)
                                    @php($i++)
                                <tr id="table-rows">
                                    <th scope="row">
                                        <input id="province_name{{$i}}" type="text" autocomplete="province_name{{$i}}"
                                               class="form-control product copy"
                                               name="province_name{{$i}}" value="{{$province->name}}"
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
