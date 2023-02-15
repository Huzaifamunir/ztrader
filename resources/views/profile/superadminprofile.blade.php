@extends('template')

@section('section1')


<div class="class="z-depth-5" style="padding:1%;background-color: white; margin-top:100px;">


<form method="post" action="{{ route('editprofile') }}" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $profile->id }}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $profile->name }}">
    </div>
    
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $profile->email }}">
    </div>
   
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <div class="form-group">
      <input type="file" name="image" >
    </div>

   
    <div style="margin-top:10px;">

    <button type="submit" class="btn btn-primary">Submit</button>

    </div>

  </form>

</div>



@stop