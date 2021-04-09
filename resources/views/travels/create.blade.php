@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-title mb-5 text-muted">
                <h3 class="float-left">toevoegen: Reizen</h3>
                <h4 class="float-right text-muted mr-2 mt-1">
                    <a href="/reizen" class="text-muted">< terug</a>
                </h4>
            </div>
            <div class="card-text">

                <form action="/admin/reizen/toevoegen" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="start_date" class="font-weight-bolder text-muted col-form-label">{{__('Start Datum')}}</label>
                            <input type="date" autocomplete="start_date"
                                   class="form-control  @error('start_date') is-invalid @enderror"
                                   name="start_date" value="{{old('start_date')}}"
                                   required autofocus>


                            @error('start_date')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="end_date" class="font-weight-bolder text-muted col-form-label">{{__('Eind Datum')}}</label>
                            <input type="date" autocomplete="end_date"
                                   class="form-control  @error('end_date') is-invalid @enderror"
                                   name="end_date" value="{{old('end_date')}}"
                                   required autofocus>


                            @error('end_date')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="font-weight-bolder text-muted col-form-label">{{__('Locatie')}}</label>
                            <select autocomplete="destination"
                                   class="form-control  @error('destination') is-invalid @enderror"
                                   name="destination"
                                   required autofocus>
                                @foreach(\App\Models\Destination::all() as $destination)
                                    <option value="{{$destination->id}}">{{$destination->location}}</option>
                                @endforeach
                            </select>


                            @error('destination')
                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="type" class="font-weight-bolder text-muted col-form-label">{{__('Soort')}}</label>
                            <input type="text" autocomplete="type"
                                   class="form-control  @error('type') is-invalid @enderror"
                                   name="type" value="{{old('type')}}"
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
                            <label for="price" class="font-weight-bolder text-muted col-form-label">{{__('prijs(€)')}}</label>
                            <input id="price" type="number" autocomplete="price"
                                   class="form-control"
                                   name="price" value="{{old('price')}}"
                                   min="0.00" step="0.01" placeholder="0.00"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12">
                                <button class="btn btn-primary float-right w-25">Toevoegen</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
