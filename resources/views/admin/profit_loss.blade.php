@extends('template')

@section('section1')
  
<br>
<div id="app" class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <div class="col s12">
    <div class="col s4">
      <a class="btn back-btn" href="{{ url(URL::previous()) }}">
        <span class="mdi mdi-arrow-left"></span>
      </a>

      <a class="btn back-btn" href="{{ route('home') }}">
        <span class="mdi mdi-menu"></span>
      </a>

      <span class="btn back-btn" onclick="print_this('sale_history')">
        <span class="mdi mdi-printer"></span>
      </span>
    </div>
    <div class="col s8">
      <h4 class="thin">
        <span class="mdi mdi-script"></span>
        Profit/Loss Report
      </h4>
    </div>
  </div>

  <div class="col s12">
    {!! Form::open(['url' => 'dashboard/profit_loss', 'method' => 'post']) !!}
      <div class="input-field col s3 offset-s3">
        <input type="date" class="datepicker" name="date1">        
        <label for="date" class="active">Date 1</label>
      </div>
      <div class="input-field col s3">
        <input type="date" class="datepicker" name="date2">        
        <label for="date" class="active">Date 2</label>
      </div>
      <div class="input-field col s2">
        {{ Form::button('<span class="mdi mdi-script"></span>', ['class'=>'btn add-btn', 'type'=>'submit']) }}
      </div>
    {{ Form::close() }}
  </div>

  @if(isset($sales))
    <div class="col s12" id="sale_history" style="background:#f5f5f5;padding:2%;">
      <div class="col s12">
        @if(isset($date1)&&isset($date2)&&isset($client))
          <h5 align="center">
            {{ $client['user']['person']['first_name'].' '.$client['user']['person']['last_name'] }}<br> 
            <!-- Balance: {{ $client['current_bal'] }}<br> -->
            ___ {{ $date1->format('d M Y') }} - {{ $date2->format('d M Y') }} ___
          </h5>
        @endif
      </div>

      <div class="col s12">
        <table class="highlight bordered">
          @if($sales->isEmpty())
            <caption>
              <h4 class="thin">Sales not found!!</h4>
            </caption>  
          @else
            <caption>
              <h4 class="thin">Sales</h4>
              <p>
                <strong>Total: {{ $total_sales }}</strong>
              </p>
            </caption>

            <thead>
              <th>Date</th>
              <th>Bill #</th>
              <th>Client</th>
              <th>Profit/Loss</th>
              <th>Amount</th>
            </thead>

            <tbody>
              @foreach($sales as $Sale)
            
                <tr>
                  <td>{{ $Sale['created_at']->format('d-M-Y') }}</td>
                  <td>ZR_00{{ $Sale['id'] }}</td>
                  <?php $get_client=\App\Models\User::where(['id' => $Sale->client_id])->first();
                  $get_client_name=explode('.',$get_client->name);?>
                 
                  <td> {{ $get_client_name[0] }} {{ $get_client_name[1] }}</td>
                  <td>{{ $Sale['total_profit'] }}</td>
                  <td>{{ $Sale['total_amount'] }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <th></th>
              <th></th>
              <th></th>
              <th>{{ $total_profit }}</th>
              <th>{{ $total_sales }}</th>
            </tfoot>
          @endif  
        </table>  
      </div>  
    </div> 
  @endif  
</div>
@stop 

@section('page_scripts')
<script src="{{ URL::asset('js/printThis.js') }}"></script>
<script>
var app = new Vue({
  el: '#app',
  delimiters: ['[[', ']]'],
  
  data: {
    client_id:null,
  },

  computed: {
    selected_client: function(){
      var client=$('#client_'+this.client_id).html();
      return client; 
    },
  },

  mounted(){
    $.get("/client",function(data, status){
      $.each(data, function(key,val){
        $("#clients_list").append("<option value='"+val.id+"' id='client_"+val.id+"'>"+val.user.person.first_name+" "+val.user.person.last_name+" "+val.current_bal+"</option>");
      });  
    });
  }
});

$("#print_receipt").click(function(){
  $("#sale_history").printThis({
    debug: false,               // show the iframe for debugging
    importCSS: true,            // import page CSS
    importStyle: false,         // import style tags
    printContainer: true,       // grab outer container as well as the contents of the selector
    loadCSS: "path/to/my.css",  // path to additional css file - use an array [] for multiple
    pageTitle: "",              // add title to print page
    removeInline: false,        // remove all inline styles from print elements
    printDelay: 333,            // variable print delay
    header: null,               // prefix to html
    footer: null,               // postfix to html
    base: false ,               // preserve the BASE tag, or accept a string for the URL
    formValues: true,           // preserve input/form values
    canvas: false,              // copy canvas elements (experimental)
    doctypeString: null,       // enter a different doctype for older markup
    removeScripts: false,       // remove script tags from print content
    copyTagClasses: false       // copy classes from the html & body tag
  });
});
</script>
@stop