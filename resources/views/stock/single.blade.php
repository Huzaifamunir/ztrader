@extends('template')

@section('section1')

<br>

<div class="col m8 l8 offset-m2 offset-l2">

<a class="btn back-btn" href="{{ url(URL::previous()) }}">
  <span class="mdi mdi-arrow-left"></span>
</a>

<span class="btn back-btn" id="print_receipt">
  <span class="mdi mdi-printer"></span>
</span>

<span class="btn back-btn" >
  PDF
</span>

</div>

<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">



  {{-- <a class="btn back-btn" href="{{ route('stock.index') }}">
    <span class="mdi mdi-menu"></span>
  </a> --}}

  {{-- <a href="#"><button class="btn btn-primary">Print</button></a> --}}



  @if($Stock==NULL)
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>
  @else
    <table class="highlight bordered">

      <caption>
        <h3 class="thin">
          <span class="mdi mdi-truck"></span>
          Stock
        </h3>
      </caption>

      <tbody>
        <tr>
          <th>Buyer</th>
          <td>{{ $Stock['user']['name']}}</td>
        </tr>
        <tr>
          <th>Provider</th>
          <td>
            <?php $get_provider=\App\Models\User::where(['id' => $Stock->provider_id])->first();
                    $get_provider=explode('.',$get_provider->name);
                ?>
                {{ $get_provider[0] }} {{ $get_provider[1] }}
          </td>
        </tr>
        <tr>
          <th >Company</th>
          <td >
            <?php $get_provider=\App\Models\User::where(['id' => $Stock->provider_id])->first();?>
                {{ $get_provider->company_name }}
          </td>
        </tr>
        <!-- <tr>
          <th>Total Items</th>
          <td>{{ $Stock->total_sets }}</td>
        </tr>
        <tr>
          <th>Total Amount</th>
          <td>Rs. {{ $Stock->total_amount }}</td>
        </tr> -->

        <tr class="table-head">
          <th style="width:100px;">Sr #</th>
          <th style="width:100px;"> Product</th>
          <th style="width:200px;">Model</th>
          <th style="width:100px;">Quantity</th>
          <th style="width:100px;">Price</th>
          <th style="width:100px;">Sub Total</th>
        </tr>

        @foreach($Stock->items as $item)
        
        <?php $get_product=\App\Models\Product::where(['id' => $item->product_id])->first();
                    $get_sub=\App\Models\SubCategory::where(['id' => $get_product->sub_category_id])->first()
                ?>

               
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $get_sub->name }}</td>
            <td>{{ $item['product']['model'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['price_per_unit'] }}</td>
            <td>{{ $item['sub_total'] }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th>{{ $Stock->total_sets }}</th>
          <th>{{ $Stock->total_amount }}</th>
        </tr>
      </tfoot>
    </table>
  @endif
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

@stop
