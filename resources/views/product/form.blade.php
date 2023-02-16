@extends('template')

   @section('section1')

  @component('components.entity_form', ['entity'=>'product','icon'=>'apple-keyboard-command'])

    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($Product, ['route' => ['product.update', $Product['id']], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
      @else
        {!! Form::open(['url' => 'product/', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      @endif

      @include('partials/_errors')

         <div class="input-field col s12 m6 l3">
          <input type="text" list="main_category_list" name="main_category_id" v-model="main_category_id" v-on:focusout="get_sub_categories">
          <label class="active">Brands</label>

          <div>
            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[[ selected_main_category ]]</label>
          </div>

          <datalist id="main_category_list">

          </datalist>

        </div>

        <div class="input-field col s12 m5 l3">
          <input type="text" list="sub_category_list" name="sub_category_id" v-model="sub_category_id">
          <label class="active">Product</label>

          <div>
            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[[ selected_sub_category ]]</label>
          </div>

          <datalist id="sub_category_list">

          </datalist>

        </div>

        {{-- <div class="input-field col s12 m5 l5">

          @component('components.text_field', ['field_name'=>'name','field_label'=>'Product Name'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent

        </div> --}}

        <div class="input-field col s6 m2 l6">

          @component('components.text_field', ['field_name'=>'model','field_label'=>'Model'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div>

        <div class="input-field col s8 m3 13">
          @component('components.text_field', ['field_name'=>'purchase_price','field_label'=>'Purchase Price'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div>

        <div class="input-field col s8 m3 13">
          @component('components.text_field', ['field_name'=>'sale_price','field_label'=>'Sale Price'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div>

        <div class="input-field col s12 m6 16">
          @component('components.text_field', ['field_name'=>'current_stock','field_label'=>'Current Stock'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div>

        {{-- <div class="input-field col s6 m3 l3">
          @component('components.text_field', ['field_name'=>'min_stock_value','field_label'=>'Minimum Stock Value'
          ,'company_id' => Auth()->user()->company_id])
          @endcomponent
        </div> --}}

        <div class="file-field input-field col s12">
          @if($form['value']=='update')
            <!--<div class="col s6">-->
            <!--  <img src="{{ URL::asset('img/product/'.$Product['image']) }}" class="responsive-img materialboxed" data-caption="{{ $Product['name'] }}" style="height:100px;width:100px;">-->
            <!--</div>-->
          @endif
          <!--<div class="col s12">-->
          <!--  <div class="btn">-->
          <!--    <span>Product Image</span>-->
          <!--    <input type="file" name="image">-->
          <!--  </div>-->
          <!--  <div class="file-path-wrapper">-->
          <!--    <input class="file-path validate" type="text">-->
          <!--  </div>-->
          <!--</div>-->
        </div>

        <div class="col s12 m12 l12"></div>

        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['product.destroy', $Product['id']]]) }}
            {{-- {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }} --}}
          {{ Form::close() }}
        </div>
      @else

      @endif
    @endslot
  @endcomponent
@stop

@section('page_scripts')

<script>
$(document).ready(function(){

    var app = new Vue({
     el: '#app',
     delimiters: ['[[', ']]'],

     data: {
     main_category_id: null,
     sub_category_id: null,
     },

      computed: {

     selected_main_category: function(){
         var main_category=$('#main_category_'+this.main_category_id).html();

         $(".main_category").remove();
              $.get("{{ App::make('url')->to('/') }}/main_category",function(data, status){
         $.each(data, function(key,val){
           $("#main_category_list").append("<option value='"+val.id+"' class=main_category id='main_category"+val.id+"'>"+val.name+"</option>");
              });
         });

      return main_category;

    },

     selected_sub_category: function(){
      var sub_category=$('#sub_category_'+this.sub_category_id).html();
      $('#sub_category_'+this.sub_category_id).remove();
      return sub_category;
    }
  },

  methods: {
     get_sub_categories: function () {

        // alert('hello');
        $(".sub_category").remove();
         $.get("{{ App::make('url')->to('/') }}/getsubcategories",
         {
         id: this.main_category_id
         },
      function(data, status){
          $.each(data, function(key,val){
          $("#sub_category_list").append("<option value='"+val.id+"' class=sub_category id='main_category_"+val.id+"'>"+val.name+"</option>");
        });
      });
    }
  },

  mounted() {


       }
});
});
</script>

@stop
