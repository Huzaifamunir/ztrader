@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}">Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



{!! Form::open(array('route' => 'companies.store','method'=>'POST')) !!}
<div class="row pt-5">
    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
        </div>
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" class="form-control" name="company_username" placeholder="Enter Company Admin Name">
        </div>
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="email" class="form-control" name="company_email" placeholder="Enter Company Admin Email">
        </div>
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="number" class="form-control" name="company_phoneno" placeholder="Enter Company Phoneno">
        </div>
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="text" class="form-control" name="company_address" placeholder="Enter Company Address">
        </div>
    </div>

    <div class="col-xs-6 col-sm-12 col-md-6">
        <div class="form-group">
            <input type="password" class="form-control" name="company_password" placeholder="Enter Company Admin Password">
        </div>
    </div>

     {{-- <div class="col-xs-12 col-sm-12 col-md-12"> --}}
        {{-- <div class="form-group"> --}}
            {{-- {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!} --}}
        {{-- </div> --}}
    </div>

  <div class="col-xs-6 col-sm-12 col-md-6">
        {{-- <div class="form-group"> --}}
            {{-- <select name="role" class="form-control"> --}}
                {{-- <option value="">Select Role</option> --}}
                {{-- @foreach($roles as $role) --}}

                  {{-- <option value="{{$role->id}}">{{$role->name}}</option> --}}

                {{-- @endforeach --}}
            {{-- </select> --}}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
