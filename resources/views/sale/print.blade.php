@extends('template')

@section('section1')
  
<br>
<div class="col m8 l8 offset-m2 offset-l2">
	<a style="background-color: #0D47A1; color:#fff;" class="btn back-btn" href="{{ url(URL::previous()) }}">
		<span class="mdi mdi-arrow-left"></span>
	</a>
	<span style="background-color: #0D47A1; color:#fff;" class="btn back-btn" id="print_receipt">
		<span class="mdi mdi-printer"></span>
	</span>

  <a style="background-color: #0D47A1; color:#fff;" id="download-button" class="btn back-btn" data-position="bottom" data-delay="200"
  data-tooltip="PDF">
  <span>PDF</span></a>

</div>


<div id="salepdf">

  <div id="sale_receipt" class="col s12 m8 l8 offset-m2 offset-l2" style="padding:1%;background-color: white;">
  <!-- <div class="col s12" style="height:35px;"></div> -->

  <div class="row">
    @if($Sale==NULL) 
      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else 
      <table class="bordered browser-default">
        <tbody>
        	<tr style="border-bottom: 2px solid black;font-size:16px;">
        		<th></th>
            <th>Bill # : ZR_{{ str_pad($Sale['id'], 3, "0", STR_PAD_LEFT) }}</th>
            <td></td>
        		<th colspan="2">
              <div align="right">
                Date : {{ $Sale->created_at->format('d-M-Y') }}
              </div>
            </th>
        	</tr>
          <tr style="border-bottom: 2px solid black;">
          	<th></th>
            <?php $get_Client_data=\App\Models\User::where(['id' => $Sale->client_id])->first();
            $get_Client=explode('.',$get_Client_data->name);
            ?>
           
            <th>Name : {{ $get_Client[0] }} {{ $get_Client[1] }}</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
          </tr>
          
          <tr style="border:2px solid black;font-size:16px;">
            <th style="width:6%;">No.</th>
            <th style="width:54%;">Description</th>
            <th style="width:10%;">Qty</th>
            <th style="width:10%;">Price</th>
            <th style="width:20%;">Amount</th>
          </tr>

          @php
          	$count = 1;
          @endphp

          @foreach($sale_item as $item) 
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $get_Client=\App\Models\Product::where(['id' => $item->product_id])->pluck('model')->first() }}</td>
              <td>{{ $item['quantity'] }}</td>
              <td>{{ $item['price_per_unit'] }}</td>
              <td>{{ $item['sub_total'] }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      
      <div class="col s12" style="font-size:16px;font-weight:bold;border-top:2px solid black;">
        <div class="col s3">
          <p>Total Amount <br>Rs.{{ $Sale['total_amount'] }}</p>
        </div>
       
        @if($Sale['payment']!=null)
        <div class="col s3">
          <p>
            <?php $get_Client_payment=\App\Models\Payment::where(['id' => $Sale->payment_id])->first() ?>
            @if($Sale['payment']['amount']!=null )
              Payment <br>Rs.{{ $get_Client_payment->amount }}
            @else
              Payment <br>Rs.0  
            @endif
          </p>
        </div>
        
        <div class="col s3">
          <p>
              {{-- {{ dd($get_Client_data->current_bal-($Sale['total_amount']-$get_Client_payment->amount)) }} --}}
            Old Balance <br>Rs.{{ $get_Client_data->current_bal-($Sale['total_amount']-$get_Client_payment->amount) }}
            {{-- {{ $Sale['client']['current_bal']-($Sale['total_amount']-$Sale['payment']['amount']) }} --}}
          </p>
        </div>
        @else
         <div class="col s3">
          <p>
           
              Payment <br>Rs.0  
          </p>
        </div>
        <div class="col s3">
          <p>
            Old Balance <br>Rs.
            {{ $get_Client_data->current_bal-($Sale['total_amount']-0) }}
          </p>
        </div>
        @endif
        <div class="col s3">
          <p>
            New Balance <br>Rs.
            {{ $get_Client_data->current_bal }}
          </p>
        </div>
      </div>
    @endif
  </div>  

  <div class="col s12" style="height:35px;"></div>
  </div>

</div>

@stop 



@section('page_scripts')
<script src="{{ URL::asset('js/printThis.js') }}"></script>
<script>
$("#print_receipt").click(function(){
	$("#sale_receipt").printThis({
	  debug: false,               // show the iframe for debugging
	  importCSS: true,            // import page CSS
	  importStyle: true,          // import style tags
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
	  doctypeString: false,       // enter a different doctype for older markup
	  removeScripts: false,       // remove script tags from print content
	  copyTagClasses: false       // copy classes from the html & body tag
	});
});
</script>

<script>
  const button = document.getElementById('download-button');

  function generatePDF() {
      // Choose the element that your content will be rendered to.
      const element = document.getElementById('salepdf');
      // Choose the element and save the PDF for your user.
      html2pdf().from(element).save();
  }

  button.addEventListener('click', generatePDF);

</script>
@stop