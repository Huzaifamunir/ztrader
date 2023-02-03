@extends('template')

      @section('section1')

    <div class="col s12 m12 l12" style="height:20px;"></div>

     <div class="col s12 m4 l4 offset-m3 offset-l3 form z-depth-5" style="padding:0px;">

      <div class='form-header pad-2'>
        <h2 class='thin font-light' align='center'>
          <span class="mdi mdi-account-key"></span>
          <span class="main-heading">S</span><span class="sub-heading-2">ign_in</span>
        </h2>
      </div>

      <div class="col s12 m12 l12">
        {!! Form::open(['url' => '/login', 'method' => 'post']) !!}

          @include('partials/_errors')

          <div class="input-field col s12">
            {!! Form::text('email', null, ['class' => 'validate', 'autofocus'=>'autofucus']) !!}
            {!! Form::label('username', 'Username') !!}
          </div>

          <div class="input-field col s12">
            {!! Form::password('password', null, ['class' => 'validate']) !!}
            {!! Form::label('password', 'Password') !!}
          </div>

          <div class="col s6">
            <br>
            {!! Form::button('<span class="mdi mdi-send"></span> Go', ['class'=>'btn form-btn', 'type'=>'submit']) !!}
          </div>

          <div class="col s6">
            <p>
              {!! Form::checkbox('remember', 'value', false, ['class'=>'checkbox-custom','id'=>'remember']) !!}
              {!! Form::label('remember', 'Remember Me') !!}
            </p>
          </div>

          <div class="col s12 m12 l12">
            <!-- <br>
            <a class="" href="{{ url('/password/email') }}">Forgot Your Password ?</a> -->
          </div>

          <div class="col s12 m12 l12" style="height:15px;"></div>

        {!! Form::close() !!}
      </div> <!-- End container div -->
    </div>


@stop
