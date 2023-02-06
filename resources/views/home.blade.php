{{-- @extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection --}}

@extends('template')

@section('section1')
<div class="col s12 m12 l12">
	<div style="height:200px;"></div>
	<center>
		<img style="    height: 285px;"  src="{{ URL::asset('public/img/logo.png') }}">
	</center>
</div>
@stop
