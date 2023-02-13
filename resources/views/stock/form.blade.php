@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'stock','icon'=>'truck'])

    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($stock, ['route' => ['stock.update', $stock['id']], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
      @else
        {!! Form::open(['url' => 'stock/', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
      @endif

      @include('partials/_errors')

      {!! Form::hidden('user_id',Auth::User()->id) !!}

        <div id="app">

          <div class="input-field col s12 m6 l6">
            <input type="text" list="providers_list" name="provider_id" v-model="provider_id" required>
            <label class="active">Select Provider</label>
            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_provider ]]</label>
            </div>

            <datalist id="providers_list">
              <!-- append providers list -->
            </datalist>
          </div>

            <datalist id="products_list">
              <!-- append products list -->
            </datalist>

          <!-- #items -->
          <div class="input-field col s12 m12 l12" id="items" v-for="(value, key) in StockItems">
            <div class="col s12 m12 l12 form-item z-depth-3">
              <div class="input-field col s2 form-header" style="padding:1%;">
                <span class="white-text sub-heading-2"># [[ key+1 ]]</span>
              </div>

              <div class="input-field col s8">
                <input type="text" list="products_list" name="product_id[]" v-model="value.product_id" v-on:input="show_product(key,value.product_id)">
                <label class="active">Select Product</label>
                <div>
                  <label :id="key+'_pnl'"></label>
                </div>
              </div>

              <div class="input-field col s2">
                <span class="btn delete-btn" v-on:click="delete_item(key)">X</span>
              </div>

              <div class="col s12"></div>

              <div class="file-field input-field col s3">
                <input type="hidden" name="company_id" value="{{ Auth()->user()->company_id}}">
                <input type="text" name="price_per_unit[]" v-model="value.price_per_unit">
                <label class="active">Price/Unit</label>
              </div>

              <div class="file-field input-field col s3">
                <input type="text" name="quantity[]" v-model="value.quantity">
                <label class="active">Quantity</label>
              </div>

              <div class="file-field input-field col s3">
                <strong>
                  SubTotal: [[ value.sub_total=value.price_per_unit*value.quantity ]]
                </strong>
                <input type="hidden" name="sub_total[]" :value="value.sub_total">
              </div>

              <div class="input-field col s2">
                <span class="btn" v-on:click="toggle_product_details(key)"><span class="mdi mdi-menu"></span></span>
              </div>

              <!-- <div class="input-field col s3">
                <span class="btn" v-on:click="find_product(value.product_id)">Details</span>
              </div> -->

              <div class="col s12" :id="key+'_product_details'" style="display:none;">
                {{-- <div class="col s4" >
                  <img src="" :id="key+'_pi'" class="responsive-img">
                </div> --}}
                <div class="col s8">
                  <p>Product: <strong :id="key+'_pn'"></strong></p>
                  <p>Model: <strong :id="key+'_pm'"></strong></p>
                  <p>General Sale Price: Rs. <strong :id="key+'_gsp'"></strong></p>
                  <p>Current Stock: <strong :id="key+'_lsp'"></strong></p>
                  <p></p>
                </div>
              </div>
            </div>
          </div><!-- /#items -->

          <div class="input-field col s12 m12 l12">
            <span class="btn add-item-btn" v-on:click="add_new_item">
              <span class="mdi mdi-plus"></span>
            </span>
          </div>

          <div class="input-field col s12 m6 offset-m6">
            <input type="hidden" name="total_sets" v-model="total_sets">
            <input type="hidden" name="total_amount" v-model="total_amount">

            <strong>Total Quantity: [[ total_sets ]]</strong><br>
            <strong>Total Amount: [[ total_amount ]]</strong>
          </div>
        </div>

        <div class="col s12 m12 l12"></div>

        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['stock.destroy', $stock['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
        </div>
      @else

      <div id="product_modal">
        <!-- Modal Structure -->
        <div id="modal1" class="modal modal-fixed-footer">
          <div class="modal-content">
            <div class="col s6">
              <img v-bind:src="'{{ URL::asset('img/product/') }}/'+product.image" class="responsive-img">
            </div>
            <!-- {{ App::make('url')->to('/') }} -->
            <!-- {{ URL::asset('img/product/') }} -->

            <div class="col s6">
              <h4>[[ product.name ]]</h4>
              <p><strong>Model:</strong> [[ product.model ]]</p>
              <p><strong>General Sale Price:<strong> Rs. [[ product.sale_price ]]</p>
              <p><strong>Current:<strong> [[ product.last_stock_price ]]</p>
            </div>
          </div>

          <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
      </div>

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
    providers_list:localStorage.getItem('Providers'),
    product: {
      id: 1, name: 'unknown', model: 'X12kk', sale_price: 0, min_stock_value: 0
    },
    provider_id: @if($form['value']=='update') {{ $stock->provider_id }} @else null @endif,
    StockItems: [
      @if($form['value']=='update')
        @foreach($stock['items'] as $item)
          {
            id: {{ $item['id'] }},
            product_id: {{ $item['product_id'] }},
            product_name: "{{ $item['product']['name'] }}",
            price_per_unit: {{ $item['price_per_unit'] }},
            quantity: {{ $item['quantity'] }},
            sub_total: {{ $item['sub_total'] }}
          },
        @endforeach
      @else
        // { id: 30, price_per_unit: 100, quantity: 3, sub_total: 300 }
      @endif
    ]
  },

  computed: {
    total_amount: function(){
      var sum=0;
      for(var i=0;i<this.StockItems.length;i++){
        sum=parseInt(sum)+parseInt(this.StockItems[i]['sub_total']);
      }
      return sum;
    },
    total_sets: function(){
      var sum=0;
      for(var i=0;i<this.StockItems.length;i++){
        sum=parseInt(sum)+parseInt(this.StockItems[i]['quantity']);
      }
      return sum;
    },
    selected_provider: function(){
      var provider=$('#provider_'+this.provider_id).html();
      return provider;
    }
  },

  methods: {
    add_new_item: function () {
      var new_item={ id: 30, price_per_unit: 100, quantity: 1, sub_total: 300 };
      this.StockItems=this.StockItems.concat(new_item);
    },
    delete_item: function (index) {
      this.StockItems.splice(index, 1);
    },
    find_product: function (id) {
      $.get("/product/"+id,function(data, status){
        app.product=data;
        $('#pn').html(data.name);
      });
      $('#modal1').modal('open');
    },
    show_product: function (key,id) {
      $.get("../../ztrader/product/"+id,function(data, status){
        // $('#'+key+'_pi').attr("src","{{ URL::asset('img/product/') }}/"+data.image);
        $('#'+key+'_pn').html(data[1].name);
        $('#'+key+'_pm').html(data[0].model);
        $('#'+key+'_gsp').html(data[0].sale_price);
        $('#'+key+'_lsp').html(data[0].current_stock);
        $('#'+key+'_pnl').html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data[1].name+" | "+data.model);
        $('#'+key+'_product_details').slideDown('slow');
        $('#'+key+'_product_details').addClass('opened');
      });
    },
    toggle_product_details: function (key) {
      if($('#'+key+'_product_details').hasClass('opened')){
        $('#'+key+'_product_details').slideUp();
        $('#'+key+'_product_details').removeClass('opened');
      }
      else{
        $('#'+key+'_product_details').slideDown('slow');
        $('#'+key+'_product_details').addClass('opened');
      }
    }
  },

  mounted() {
    $.get("{{ App::make('url')->to('/') }}/user_list",function(data, status){
      $.each(data, function(key,val){
        $("#providers_list").append("<option value='"+val.id+"' id='provider_"+val.id+"'>"+val.company_name+"</option>");
      });
    });

    $.get("{{ App::make('url')->to('/') }}/product_list",function(data, status){
      $.each(data, function(key,val){
        $("#products_list").append("<option value='"+val.id+"'>"+val.model+" | "+val.current_stock+" | Rs."+val.sale_price+"</option>");
      });
    });
  }
});
</script>
@stop
