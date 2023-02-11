
@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'sub_category','icon'=>'account'])

    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($SubCategory, ['route' => ['sub_category.update', $SubCategory['id']], 'method' => 'patch']) !!}
      @else
        {!! Form::open(['url' => 'sub_category/', 'method' => 'post']) !!}
      @endif

      @include('partials/_errors')

        <div class="input-field col s12 m6 l6" id="app">

          <input type="text" list="main_category_list" name="maian_category_id" v-model="main_category_id">

          <label class="active">Select Brand</label>
          <div>
            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_Brand ]]</label>
          </div>

          <datalist id="main_category_list">

          </datalist>

        </div>

        <div class="input-field col s12 m6 l6">
          @component('components.text_field', ['field_name'=>'name','field_label'=>'Product'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div>

        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
      
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['sub_category.destroy', $SubCategory['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else

      @endif
    @endslot
  @endcomponent
@stop

@section('page_scripts')
<script>

var app = new Vue({

  el: '#app',
  delimiters: ['[[', ']]'],
  data: {
    main_category_id: @if($form['value']=='update'){{ $SubCategory['main_category_id'] }}@else null @endif,
  },
  computed: {
    selected_main_category: function(){
      var main_category=$('#main_category_'+this.main_category_id).html();
      return main_category;
    }
  },
  mounted(){
    $.get("{{ App::make('url')->to('/') }}/main_category", function(data, status){
      $.each(data, function(key,val){
          $('.subcategory').remove();
        $("#main_category_list").append("<option value='"+val.id+"' class=`subcategory` id='main_category_"+val.id+"'>"+val.name+"</option>");
        });
     });
  },
});
</script>
@stop
