@extends('layouts.master')


@section('content')
<div class="row" style="justify-content:center;">
    <div class="col-6">

<div class="form-div">
<div class="row" style="color: #fff;
padding: 20px;
background: #0d47a1;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit New User</h2>
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


{!! Form::model($user, ['method' => 'PATCH','route' => ['companies.update', $user->id]]) !!}
<div class="row">

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <input type="text" value="{{$user->company_name}}" class="form-control" name="company_name" placeholder="Enter Company Name">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <input type="email" value="{{$user->company_email}}" class="form-control" name="company_email" placeholder="Enter Company Email">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <input type="tel" value="{{$user->company_phoneno}}" class="form-control" name="company_phoneno" placeholder="Enter Company Phoneno">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <input type="password" value="{{$user->company_password}}" class="form-control"  name="company_password" placeholder="Enter Company Password">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center" style="display:flex; justify-content:space-between">

        <div>
        <button type="submit" class="btn btn-primary">Update</button>
        </div>

        <div  style="margin-left:370px;">

            {!! Form::open(['method' => 'DELETE','route' => ['companies.destroy', $user->id],'style'=>'display:inline']) !!}
            
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

            {!! Form::close() !!}

        </div>



    </div>
    
</div>
{!! Form::close() !!}

@endsection
</div></div></div>