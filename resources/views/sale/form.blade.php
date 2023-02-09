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

        <div>
          {{-- <div class="input-field col s12 m6 l6">
            <select name="user_type" id="client_type" required>
              <option  value="RC" selected>Client Name</option>
              @foreach ($client as  $item)

              <option name="client_id">{{ $item->name }}</option>
                
              @endforeach
            
            </select>      
          </div> --}}

          <div class="input-field col s12 m6 l6" id="rc_container">
            <input type="text" list="users_list" name="client_id" v-model="client_id">
            <label class="active">Client</label>
            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_client ]]</label>
            </div>

            <datalist id="users_list">
              {{-- append salesmen list --}}
            </datalist>
          </div>

          <div class="input-field col s12" id="wc_container" style="background:#eeeeee;display:none;">
            <div class="input-field col s4">
              <input type="text" name="first_name">
              <label>First Name</label>
            </div>

            <div class="input-field col s4">
              <input type="text" name="last_name">
              <label>Last Name</label>
            </div>

            <div class="input-field col s4">
              <input type="number" name="current_bal">
              <label>Current Balance</label>
            </div>

            <div class="input-field col s6">
              <input type="text" name="land_line_no">
              <label>Landline #</label>
            </div>

            <div class="input-field col s6">
              <input type="text" name="mobile_no">
              <label>Mobile #</label>
            </div>
            
            <div class="input-field col s4">
              {!! Form::select('city_id', 
                $Cities->pluck('name', 'id')->all(), 
                null, ['placeholder' => 'Select City']) !!}
            </div> 

            <div class="input-field col s8">
              <input type="text" name="address">
              <label>Address</label>
            </div>

          </div>

          <div class="col s12"></div>

          <div class="input-field col s6">
            <input type="text" list="products_list" v-model="product_id">
            <label class="active">Product</label>

            <div>
              <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; [[ selected_product ]]</label>
            </div>

            <datalist id="products_list">
              <!-- append products list -->
            </datalist>
          </div>

          <div class="input-field col s2">
            <input class="validate" type="number" v-model="qnty" min="1" :max="crnt_stck">
            <label class="active">Quantity</label>
          </div>

          <div class="input-field col s2">
            <input type="text" v-model="prce">
            <label class="active">Price</label>
          </div>

          <div class="input-field col s2">
            <span class="btn add-item-btn" v-on:click="add_new_item">
              <span class="mdi mdi-plus"></span>
            </span>
          </div>

          <div class="col s12" style="background:#eeeeee;">
            <table class="highlight bordered">
              <thead>
                <tr>
                  <th>Sr #</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>SubTotal</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="(value, key) in SaleItems">
                  <td>
                    [[ key+1 ]]
                  </td>
                  <td>
                    [[ value.product_name ]]
                    <input type="hidden" name="product_id[]" :value="value.product_id">
                  </td>
                  <td>
                    [[ value.quantity ]]
                    <input type="hidden" name="quantity[]" :value="value.quantity">
                  </td>
                  <td>
                    [[ value.price_per_unit ]]
                    <input type="hidden" name="price_per_unit[]" :value="value.price_per_unit">
                  </td>
                  <td>
                    [[ value.sub_total ]]
                    <input type="hidden" name="sub_total[]" :value="value.sub_total">
                  </td>
                  <td>
                    <span class="delete-btn" v-on:click="delete_item(key)">
                      <span class="mdi mdi-close"></span>
                    </span>
                  </td>
                </tr>
              </tbody>

              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>[[ total_sets ]]</th>
                  <th>[[ total_amount ]]</th>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <div class="col s12 m12 l12" style="height:20px;"></div>

          <div class="col s12" style="background:#eeeeee;padding:1%;">
            <div class="col s6 offset-s6">
              <div class="col s4">
                <strong>Quantity</strong>
                <p>[[ total_sets ]]</p>
                <input type="hidden" name="total_sets" :value="total_sets">
              </div>
              <div class="col s4">
                <strong>Total</strong>
                <p>[[ total_amount ]]</p>
                <input type="hidden" name="total_amount" :value="total_amount">
              </div>
              <div class="col s4">
                <strong>Payment</strong>
                <p>
                  <input type="number" name="payment" v-model="payment" step="0.00" min="0" :max="total_amount">
                </p>
                <br>
              </div>
            </div>  
          </div>

          <!-- <div class="col s12 m6 offset-m6">
            <div class="input-field col s6">
              <input type="number" name="payment" value="0" step="0.00" min="0" v-bind:max="total_amount">
              <label class="active">Payment</label>
            </div>
          </div> -->
        </div>

        <div class="col s12 m12 l12"></div>
        
        <div class="input-field col s6 m6 l6">
          {{ Form::button('<span class="mdi mdi-send"></span> Save', ['class'=>'btn', 'type'=>'submit']) }}
        </div>
      {!! Form::close() !!}

      @if($form['value']=='update')
        <div class="input-field col s6 m6 l6">
          {{ Form::open(['method'=>'delete', 'route'=>['sale.destroy', $Sale['id']]]) }}
            {{ Form::button('<span class="mdi mdi-delete"></span> Delete', ['class'=>'btn delete-btn', 'type'=>'submit']) }}
          {{ Form::close() }}
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
    client_id:null,
    items_count:@if($form['value']=='update') 1 @else 0 @endif,
    payment_min:0,
    payment_max:0,
    user_id: {!! Auth::User()->id !!},
    client_id: @if($form['value']=='update') {{ $Sale['client_id'] }} @else 1 @endif,
    product_id: null,
    p_id: null,
    prce: 0,
    qnty: 1,
    payment: @if($form['value']=='update') @if($Sale['payment']!=null) {{$Sale['payment']['amount'] }} @else 0 @endif @else 0 @endif,
    crnt_stck: null,
    crnt_bal: null,
    product: {
      id: null, name: 'unknown', model: 'X12kk', sale_price: 0, current_stock:0, min_stock_value: 0
    },
    SaleItems: [
      @if($form['value']=='update') 
        @foreach($Sale['items'] as $item)
          { 
            id: {{ $item['id'] }}, 
            product_id: {{ $item['product_id'] }}, 
            product_name: "{{ $item['product']['model'] }}", 
            price_per_unit: {{ $item['price_per_unit'] }}, 
            quantity: {{ $item['quantity'] }}, 
            sub_total: {{ $item['sub_total'] }} 
          },
        @endforeach
      @else 
        // { id: 1, product_id: 1, product_name: 'some_name', price_per_unit: 100, quantity: 2, sub_total: 200 }
      @endif
    ],
    products_list:null
  },
  
  computed: {
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
    },
    selected_product: function(){
      var product=$('#product_'+this.product_id).html();
      $.each(this.products_list, function(key,val){ console.log(val.id);
        if(val.id==app.product_id){
          app.product=val;
          app.prce=parseInt(val.sale_price);
          app.crnt_stck=parseInt(val.current_stock);
          app.crnt_bal=parseInt(val.current_balance); 
        }
      });
      return product; 
    }
  },
  
  methods: {
    add_new_item: function () {
      if(this.items_count==30){
        Materialize.toast('Max limit is 30', 1000, 'red');
      }
      else{
        if(this.qnty>parseInt(this.product.current_stock)){
          Materialize.toast('Quantity is more than current stock!!', 1000, 'red');
        }else{
          var new_item={ id: 1, product_id: this.product_id, product_name: this.product.model, price_per_unit: this.prce, quantity: this.qnty, sub_total: this.qnty*this.prce };  
          this.SaleItems=this.SaleItems.concat(new_item);
          this.product_id=null;
          this.qnty=1;
          this.prce=0;
          this.items_count++;
          Materialize.toast('Item added', 1000, 'green');
        }
      }  
    },
    delete_item: function (index) {
      this.SaleItems.splice(index, 1);
      this.items_count--;
      Materialize.toast('Item removed', 1000, 'red');
    },
    show_product: function (key,id) {
      $.get("../../ztrader/product/"+id,function(data, status){
        $('#'+key+'_pi').attr("src","{{ URL::asset('img/product/') }}/"+data.image); 
        $('#'+key+'_pn').html(data.name); 
        $('#'+key+'_pm').html(data.model);    
        $('#'+key+'_gsp').html(data.sale_price);    
        $('#'+key+'_lsp').html(data.current_stock);    
        $('#'+key+'_pnl').html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.name+" | "+data.model);
        $('#'+key+'_product_details').hide().slideDown('slow');    
        $('#'+key+'_product_details').addClass('opened');    
      });
    }
  },

  mounted() {
    $.get("../../../ztrader/user",function(data, status){
      
      $.each(data, function(key,val){
        console.log(val);
        var result = val.name.split(".");
console.log(result[0]);
        $("#users_list").append("<option value='"+val.id+"' id='user_"+val.id+"'>"+result[0]+" "+result[1]+"</option>");
      });  
    });

    $.get("../../../ztrader/client",function(data, status){
   
      $.each(data, function(key,val){
        
        $("#clients_list").append("<option value='"+val.id+"' id='client_"+val.id+"'>"+val.user.person.first_name+" "+val.user.person.last_name+" "+val.current_bal+"</option>");
      });  
    });

    $.get("../../../ztrader/product",function(data, status){
      $.each(data, function(key,val){
        $("#products_list").append("<option value='"+val.id+"' id='product_"+val.id+"'>"+val.model+" | "+parseInt(val.current_stock)+" | Rs."+val.sale_price+"</option>");
      });
      app.products_list=data;  
    });

    $('#client_type').change(function(event){
      if(event.target.value=='RC'){
        $('#wc_container').slideUp();
        $('#rc_container').hide().slideDown();
      }
      else if(event.target.value=='WC'){
        $('#rc_container').slideUp();
        $('#wc_container').hide().slideDown();
      }
    });

    $("form").submit(function(){
    /*  app.add_new_item();
      return false; */

      if(app.items_count==0){
        Materialize.toast('Please add atleast one item in receipt.', 2000, 'orange');
        return false;
      }

      if($('#client_type').val()=="RC"){
        if(app.client_id==1){
          if(app.payment!=app.total_amount){
            Materialize.toast('You have to pay full amount for Cash Client.', 2000, 'orange');
            return false;
          }
        }
        else{
          return true;
        }
      }
    });
  }
});
</script>
@stop