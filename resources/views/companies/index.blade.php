@extends('template')


@section('section1')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2 style="color:#fff;">Companies Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered " style="background-color:#fff;" >
 <tr >
  {{-- <th>No</th>--}}
   <th style="width:100px;">Name</th>
   <th style="width:100px;">Company Name</th>
   <th style="width:20px;">Phone</th>
   <th style="width:30px;">Email</th>
   <th style="width:150px;">Address</th>
   <th style="width:150px;">Action</th>
 </tr>

 {{-- {{ dd($data) }} --}}
 @foreach ($data as $key => $user)

 {{-- {{ dd($user) }} --}}
  <tr style="border:1px solid black;"> 
    {{-- <td>{{ ++$i }}</td> --}}

    {{-- {{ dd($get_user) }} --}}
    <td>{{ $user->name }}</td>
    <td>{{ $user->company_name }}</td>
    <td>{{ $user->company_phoneno}}</td>
    <td>{{ $user->company_email}}</td>
    <td>{{ $user->company_address }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('companies.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('companies.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['companies.destroy', $user->id],'style'=>'display:inline']) !!}
            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>



@endsection
