@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'main_category','icon'=>'account'])

    @slot('form')


      @if($form['value']=='update')
        {!! Form::model($MainCategory, ['route' => ['main_category.update', $MainCategory['id']], 'method' => 'patch']) !!}
        @else
        {!! Form::open(['route' => 'main_category.store', 'method' => 'post']) !!}
        <input type="hidden" value="{{ Auth()->user()->company_id }}" name="company_id" for="company_id" />
      @endif

      @include('partials/_errors')

      <div class="input-field col s12 m12 l12">
        @component('components.text_field', ['field_name'=>'name','field_label'=>' Name'
        ,'company_id' =>  Auth()->user()->company_id  ])
        @endcomponent
      </div>

      <div class="input-field col s6 m6 l6">
        {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
      </div>

      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['main_category.destroy', $MainCategory['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else

      @endif
    @endslot
  @endcomponent
@stop
