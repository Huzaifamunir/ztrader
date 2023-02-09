@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'country','icon'=>'account'])
    
    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($Country, ['route' => ['country.update', $Country['id']], 'method' => 'patch']) !!}
      @else
        {!! Form::open(['url' => 'country/', 'method' => 'post']) !!}
      @endif
        
      @include('partials/_errors')

      {!! Form::hidden('user_id', '1') !!}

        <div class="input-field col s12 m6 l12">
          @component('components.text_field', ['field_name'=>'name','field_label'=>'Country Name'])
          @endcomponent
        </div>
   
        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['country.destroy', $Country['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else  

      @endif
    @endslot
  @endcomponent
@stop 