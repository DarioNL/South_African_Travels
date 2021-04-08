@extends('layouts.app')

@section('content')
    <div class="row pr-4 pl-4 h-75">
        <img  src="{{asset('images/train.jpg')}}" alt="" title="" height="auto" width="auto"  sizes="(max-width: 600px) 100vw, 600px" class="bg-image p-0 col-4 w-100" />
        <img  src="{{asset('images/Airplane.jpg')}}" alt="" title="" height="auto" width="auto" sizes="(max-width: 600px) 100vw, 600px" class="bg-image p-0 col-4"/>
        <img   src="{{asset('images/bus.jpg')}}" alt="" title="" height="auto" width="auto"  sizes="(max-width: 600px) 100vw, 600px" class="bg-image p-0 col-4" />
    </div>
@endsection
