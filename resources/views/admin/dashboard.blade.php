@extends('template')
@section('section1')




@role('admin')
<div class="col s12 m12 l12">
  <center>
    <h2 class="thin">
      <span class="mdi mdi-view-dashboard"></span>Dashboard
    </h2> 
  </center>
</div>



<div class="col s12 m12 l12" id="app">
  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('dashboard.today_sales') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
            <span class="mdi mdi-script"></span>
          </h3>
          <h5 class="thin" align="center">Transactions</h5>
        </div>
      </a>
      <div class="col s6 m6 l6" style="font-size:12px;">
        <a href="{{ route('dashboard.profit_loss') }}">
          <h5></h5>
        </a>
        <a href="{{ route('dashboard.today_sales') }}">
          <h5></h5>
        </a><br>
        <h6>Today &#40;[[ transactions.total ]]&#41;</h6>
        <p>
          <strong>Sales: [[ transactions.total_sales ]]</strong>
        </p>
        <p>
          <strong>Payments: [[ transactions.total_payments ]]</strong>
        </p>
      </div>
    </div>
  </div>


  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('sale.index') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
            <span class="mdi mdi-script"></span>
          </h3>
          <h5 class="thin" align="center">Today Sales</h5>
        </div>
      </a>
      <div class="col s6 m6 l6" style="font-size:12px;">
        <h6>Total &#40;[[ transactions.total_sales ]]&#41;</h6>
        @foreach($sales as $sale)
       {{-- {{ dd($sale) }} --}}
        <?php $get_client_name=\App\Models\User::where(['id' => $sale->client_id])->first();
        $get_client=explode('.',$get_client_name->name);
    ?>
     
          <a href="{{ route('sale.show',[$sale->id]) }}">
            {{ $get_client[0] }} {{ $get_client[1] }}
          </a>
          Rs. {{ $sale['total_amount'] }}<br>
        @endforeach
      </div>
    </div>
  </div>

  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('payment.index') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
            <span class="mdi mdi-script"></span>
          </h3>
          <h5 class="thin" align="center">Today Payments</h5>
        </div>
      </a>
      <div class="col s6 m6 l6" style="font-size:12px;">
        <h6>Total &#40;[[ transactions.total_payments ]]&#41;</h6>
        @foreach($payments as $payment)
        
      
        <?php $get_payment_client=\App\Models\User::where(['id' => $payment->payer_id])->pluck('name')->first();
          $get_payment_name=explode('.',$get_payment_client);?>
         

          <a href="{{ route('payment.show',$payment->id) }}">
            {{ $get_payment_name[0] }} 
          </a>
      
          Rs. {{ $payment['amount'] }}<br>
         
        @endforeach
      </div>
    </div>
  </div>

  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('dashboard.current_stock') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
            <span class="mdi mdi-chart-pie"></span>
          </h3>
          <h5 class="thin" align="center">Current Stock</h5>
        </div>
      </a>
      <div class="col s6 m6 l6">
        
      </div>
    </div>
  </div>
  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('dashboard.report') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
             <span class="mdi mdi-account-star"></span>
          </h3>
          <h5 class="thin" align="center">Client Reports</h5>
        </div>
      </a>
      <div class="col s6 m6 l6" style="font-size:12px;overflow-y:scroll;">
        
      </div>
    </div>
  </div>
 
  <div class="col s12 m6 l4">
    <div class="col s12 m12 l12 menu-tab z-depth-4">
      <a href="{{ route('dashboard.profit_loss') }}">
        <div class="col s6 m6 l6">
          <h3 align="center">
            <span class="mdi mdi-apple-keyboard-command"></span>
          </h3>
          <h5 class="thin" align="center">Loss Profit</h5>

          
        </div>
      </a>
     
    </div>
  </div>
  

</div> <!-- #app -->

@endrole

@stop

@section('page_scripts')
<script>
var app = new Vue({
  el: '#app',
  delimiters: ['[[', ']]'],
  
  data: { 
    auth_user: {!! Auth::User() !!},
    transactions: { total_sales: null, total_payments: null,total: null },
    stock: { total_sales: null, total_payments: null },
    client: { total_sales: null, total_payments: null },
    salesman: { total_sales: null, total_payments: null },
    provider: { total_sales: null, total_payments: null },
    reseller: { total_sales: null, total_payments: null }
  },
  
  computed: {

  },
  
  methods: {

  },

  mounted() {
    $.get("../../ztrader/dashboard/today_sales",function(data, status){
      app.transactions = data;
    });
  }
});
</script>
@stop