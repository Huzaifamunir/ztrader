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
            <h2> Show Company</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('companies.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row" style=" padding: 20px;">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="column">
             <div class="col-label"><strong>Name:</strong></div> 
        <div class="col-name">{{ $user->company_name }} </div>    
            </div>
        
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="column">
                <div class="col-label"><strong>Email:</strong></div> 
           <div class="col-name">{{ $user->company_email }} </div>    
               </div>
          
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <div class="column">
                <div class="col-label"><strong>Phoneno:</strong></div> 
           <div class="col-name">{{ $user->company_phoneno }} </div>    
               </div>
        </div>
    </div>
</div>
@endsection
</div>
</div>
</div>