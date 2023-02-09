@extends('template')

@section('section1')

  @component('components.entity_form', ['entity'=>'sale','icon'=>'script'])
    
    @slot('form')

      @if($form['value']=='update')
        {!! Form::model($Sale, ['route' => ['sale.update', $Sale['id']], 'method' => 'patch']) !!}
      @else
        {!! Form::open(['url' => 'sale/', 'method' => 'post']) !!}
      @endif
        
      {!! Form::hidden('seller_id',Auth::User()->id) !!}

      @include('partials/_errors')

        <div id="app">
          <div class="input-field col s12 m6 l6">
            <h5>
              --- Seller ---<br>
              <strong>
                {{ Auth::User()->person['first_name'].' '.Auth::User()->person['last_name'] }}
              </strong>
            </h5>
            <!-- <input type="text" list="users_list" name="user_id" v-model="user_id">
            <label class="active">Select Seller</label> -->

            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_user ]]</label>
            </div>

            <datalist id="users_list">
              <!-- append users list -->
            </datalist>
          </div>

          <div class="input-field col s12 m6 l6">
            <input type="text" list="clients_list" name="client_id" v-model="client_id">
            <label class="active">Select Client</label>

            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_client ]]</label>
            </div>

            <datalist id="clients_list">
              <!-- append salesmen list -->
            </datalist>
          </div>

          <datalist id="products_list">
            <!-- append products list -->
          </datalist>
          
          <!-- #items -->
          <div class="input-field col s12 m12 l12" id="items" v-for="(value, key) in SaleItems">
            <div class="col s12 m12 l12 form-item z-depth-3">
               
              <div class="input-field col s8">
                <input type="text" list="products_list" name="product_id[]" v-model="value.product_id" v-on:input="show_product(key,value.product_id)">
                <label class="active">Select Product</label>
                <div>
                  <label :id="key+'_pnl'"></label>
                </div>
              </div>

              <div class="col s2"></div>

              <div class="col s2 form-header" style="padding:1%;">
                <span class="white-text sub-heading-3">
                  # [[ key+1 ]]
                  <span class="btn delete-btn" v-on:click="delete_item(key)">
                    <span class="mdi mdi-close"></span>
                  </span>
                </span>
              </div>
              
              <!-- <div class="input-field col s2">
                <span class="btn delete-btn" style="float:right;" v-on:click="delete_item(key)">X</span>
              </div> -->  
              
              <div class="col s12 m12 l12"></div>

              <div class="input-field col s3">
                <input type="number" name="price_per_unit[]" v-model="value.price_per_unit">
                <label class="active">Price/Unit</label>  
              </div>  

              <div class="input-field col s3">
                <input type="number" name="quantity[]" v-model="value.quantity">
                <label class="active">Quantity</label>  
              </div>

              <div class="input-field col s3">
                <input type="hidden" name="sub_total[]" v-model="value.sub_total">
                <strong>
                  SubTotal: [[ value.sub_total=value.price_per_unit*value.quantity ]]
                </strong>
              </div>  

              <div class="input-field col s2">
                <span class="btn" v-on:click="toggle_product_details(key)"><span class="mdi mdi-menu"></span></span>          
              </div>

              <div class="col s12" :id="key+'_product_details'" style="display:none;">
                <div class="col s4">
                  <img src="" :id="key+'_pi'" class="responsive-img">
                </div>
                <div class="col s8">
                  <p>Name: <strong :id="key+'_pn'"></strong></p>
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

          <div class="col s12 m12 l12" style="height:20px;"></div>

          <!-- <div class="input-field col s12 m4 l4">
            <input type="number" name="total_quantity" readonly v-model="total_sets">
            <label class="active">Total Quantity</label>
          </div>

          <div class="input-field col s12 m4 l4">
            <input type="number" name="total_amount" readonly v-model="total_amount">
            <label class="active">Total Amount</label>
          </div> -->
          <div class="col s12 m6 offset-m6">
            <div class="col s6">
              <input type="hidden" name="total_sets" v-model="total_sets">
              <input type="hidden" name="total_amount" v-model="total_amount">

              <strong>Total Sets: [[ total_sets ]]</strong><br>
              <strong>Total Amount: Rs. [[ total_amount ]]</strong><br>
            </div>
            
            <div class="input-field col s6">
              <input type="number" name="payment" value="0" step="0.00" min="0" v-bind:max="total_amount">
              <label class="active">Payment</label>
            </div>
          </div>
        </div>

        <div class="col s12 m12 l12"></div>
        
        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> '.$form['value'], ['class'=>'btn add-btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['sale.destroy', $Sale['id']]]) }}
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

            <div class="col s6">
              <h4>[[ product.name ]]</h4>
              <p><strong>Model:</strong> [[ product.model ]]</p>
              <p><strong>General Sale Price:<strong> [[ product.sale_price ]].00 &euro;</p>
              <p><strong>Last Purchase Price:<strong> [[ product.last_stock_price ]].00 &euro;</p>
              <p><strong>Current Stock:<strong> [[ product.product_current_stock ]]</p>
              <p><strong>Salesmen Stock:<strong> [[ product.salesmen_stock ]]</p>  
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
    user_id: {!! Auth::User()->id !!},
    client_id: null,
    product: {
      id: null, name: 'unknown', model: 'X12kk', sale_price: 0, min_stock_value: 0
    },
    SaleItems: [
      { id: 1, product_id: null, price_per_unit: 1, quantity: 1, sub_total: 1 }
    ]
  },
  
  computed: {
    total_sets: function(){
      var sum=this.price_per_unit*this.quantity;
      return sum; 
    },
    total_sets: function(){
      var sum=0;
      for(var i=0;i<this.SaleItems.length;i++){
        sum=sum+parseInt(this.SaleItems[i].quantity);
      }
      return sum; 
    },
    total_amount: function(){
      var sum=0;
      for(var i=0;i<this.SaleItems.length;i++){
        sum=sum+parseInt(this.SaleItems[i].price_per_unit*this.SaleItems[i].quantity);
      }
      return sum; 
    },
    selected_user: function(){
      var user=$('#user_'+this.user_id).html();
      return user; 
    },
    selected_client: function(){
      var client=$('#client_'+this.client_id).html();
      return client; 
    }
  },
  
  methods: {
    add_new_item: function () {
      var new_item={ id: 1, product_id: null, price_per_unit: 1, quantity: 1, sub_total: 1 };  
      this.SaleItems=this.SaleItems.concat(new_item);
    },
    delete_item: function (index) {
      this.SaleItems.splice(index, 1);
    },
    show_product: function (key,id) {
      $.get("/product/"+id,function(data, status){
        console.log(data);
        $('#'+key+'_pi').attr("src","{{ URL::asset('img/product/') }}/"+data.image); 
        $('#'+key+'_pn').html(data.name); 
        $('#'+key+'_pm').html(data.model);    
        $('#'+key+'_gsp').html(data.sale_price);    
        $('#'+key+'_lsp').html(data.current_stock);    
        $('#'+key+'_pnl').html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.name+" | "+data.model);
        $('#'+key+'_product_details').hide().slideDown('slow');    
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
    $.get("/user",function(data, status){
      $.each(data, function(key,val){
        $("#users_list").append("<option value='"+val.id+"' id='user_"+val.id+"'>"+val.person.first_name+" "+val.person.last_name+"</option>");
      });  
    });

    $.get("/client",function(data, status){
      $.each(data, function(key,val){
        $("#clients_list").append("<option value='"+val.id+"' id='client_"+val.id+"'>"+val.user.person.first_name+" "+val.user.person.last_name+"</option>");
      });  
    });

    $.get("/products_list",function(data, status){
      $.each(data, function(key,val){
        $("#products_list").append("<option value='"+val.id+"'>"+val.name+" | "+val.model+" | "+val.current_stock+" | Rs."+val.sale_price+"</option>");
      });  
    });

    // $.get("/product",function(data, status){
    //   $.each(data, function(key,val){
    //     $("#products_list").append("<option value='"+val.id+"'>"+val.name+" | "+val.sale_price+"</option>");
    //   });  
    // });

    // $.get("/product_stock",function(data, status){
    //   $.each(data, function(key,val){
    //     $("#products_list").append("<option value='"+val.id+"'>"+val.name+" | "+val.model+" | "+val.stock+" | "+val.stock_price+".00 &euro;</option>");
    //   });  
    // });
  }
});
</script>
@stop