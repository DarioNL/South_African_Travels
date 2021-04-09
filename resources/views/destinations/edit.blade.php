@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">Bijwerken: {{$destination->code}}</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/admin/bestemmingen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/bestemmingen/{{$destination->id}}/wijzigen" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <label for="" class="font-weight-bolder text-muted col-form-label">{{__('Locatie')}}</label>
                            <input type="text" autocomplete="location"
                                   class="form-control  @error('location') is-invalid @enderror"
                                   name="location" value="{{$destination->location}}"
                                   required autofocus>


                            @error('location')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="font-weight-bolder text-muted col-form-label">{{__('Provincie')}}</label>
                            <a  href="/admin/landen">+ Voeg Een Nieuwe Provincie Toe</a>
                            <select name="province" id="cars" class="form-control  @error('destination') is-invalid @enderror"
                                    name="destination"
                                    required autofocus>
                                @foreach($countries as $country)
                                    <optgroup label="Provincies uit {{$country->name}}">
                                        @foreach($country->Provinces as $province)
                                            <option @if($destination->Province->id == $province->id) selected @endif value="{{$province->id}}">{{$province->name}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>


                            @error('province')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="photo" class="font-weight-bolder text-muted col-form-label">{{__('Foto')}}</label>
                        <input id="photo" type="file" accept="image/*" class="form-control-file" name="photo" required>


                        @error('photo')
                        <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                    <div class="row pt-3">
                        <div class="col-12">
                            <a class="new-accommodation" href="#">+ Voeg Een Nieuwe Accommodatie Toe</a>
                            <table class=" border-bottom border-top order-table w-100">
                                <tr class="border-bottom text-secondary order-table-header" style="box-shadow: none !important; font-weight: normal">
                                    <th class="order">Aantal kamers</th>
                                    <th class="order">Soort</th>
                                    <th class="order">Ligging</th>
                                </tr>
                                <tbody class="product" id="order-table">
                                @php($i = 0)
                                @php($accommodations = $destination->accommodations->count())
                                @if($accommodations == 0)
                                    @php($i = 1)
                                    <tr id="table-rows">
                                        <th scope="row">
                                            <input id="chambers1" type="number" autocomplete="chambers1"
                                                   class="form-control product copy" min="1"
                                                   name="chambers1" value="{{old('chambers1')}}"
                                                   required autofocus>
                                        </th>
                                        <td>
                                            <input type="text" autocomplete="type1"
                                                   class="form-control copy"
                                                   name="type1" value="{{old('type1')}}"
                                                   required autofocus>
                                        </td>
                                        <td>
                                            <input id="range1" type="text" autocomplete="range1"
                                                   class="form-control product copy"
                                                   name="range1" value="{{old('range1')}}"
                                                   required autofocus>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($destination->accommodations as $accommodation)
                                    @php($i++)
                                    <tr id="table-rows">
                                        <th scope="row">
                                            <input id="chambers{{$i}}" type="number" autocomplete="chambers{{$i}}"
                                                   class="form-control product copy" min="1"
                                                   name="chambers{{$i}}" value="{{$accommodation->chambers}}"
                                                   required autofocus>
                                        </th>
                                        <td>
                                            <input type="text" autocomplete="type{{$i}}"
                                                   class="form-control copy"
                                                   name="type{{$i}}" value="{{$accommodation->type}}"
                                                   required autofocus>
                                        </td>
                                        <td>
                                            <input id="range{{$i}}" type="text" autocomplete="range{{$i}}"
                                                   class="form-control product copy"
                                                   name="range{{$i}}" value="{{$accommodation->range}}"
                                                   required autofocus>
                                        </td>
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
