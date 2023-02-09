@extends('template')

@section('section1')
  
<br>
<div class="col s12 m8 l8 offset-m2 offset-l2 z-depth-5" style="padding:3%;background-color: white;">

  <a class="btn back-btn" href="{{ url(URL::previous()) }}">
    <span class="mdi mdi-arrow-left"></span>
  </a>

  <a class="btn print-btn" href="{{ route('sale.print', [ $Sale['id']]) }}">
    <span class="mdi mdi-printer"></span> Print
  </a>

  @if($Sale==NULL) 
    <center>
      <h3 class="thin">No Record Found !</h3>
    </center>  
  @else 
    <table class="highlight bordered">
      
      <caption>
        <h3 class="thin">
          <span class="mdi mdi-script"></span>
          Sale
        </h3>
      </caption>

      <tbody>
        <tr>
          <th>Sale Date</th>
          <td>{{ $Sale->created_at->format('d-M-Y') }}</td>
        </tr>
        <tr>
          <th>Client</th>
          <td>{{ $Sale['client']['user']['person']['first_name']." ".$Sale['client']['user']['person']['last_name'] }}</td>
        </tr>
        <tr>
          <th>Salesman</th>
          <td>{{ $Sale['seller']['person']['first_name']." ".$Sale['seller']['person']['last_name'] }}</td>
        </tr>
        <tr>
          <th>Total Items</th>
          <td>{{ $Sale->total_sets }}</td>
        </tr>
        <tr>
          <th>Total Amount</th>
          <td>{{ $Sale->total_amount }}.00&euro;</td>
        </tr>
        
        <tr class="table-head">
          <th>Sr #</th>
          <th>Product</th>
          <th>Model</th>
          <th>Sale Price/Unit</th>
          <th>Quantity</th>
          <th>Sub Total</th>
        </tr>

        @foreach($Sale->items as $item) 
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['product']['name'] }}</td>
            <td>{{ $item['product']['model'] }}</td>
            <td>{{ $item['price_per_unit'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ $item['sub_total'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif  
</div>

@stop 