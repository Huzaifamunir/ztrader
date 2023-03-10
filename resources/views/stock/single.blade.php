@extends('template')

@section('section1')

<br>

<div class="col m8 l8 offset-m2 offset-l2">

<a class="btn back-btn" href="{{ url(URL::previous()) }}">
  <span class="mdi mdi-arrow-left"></span>
</a>

<a id="download-button" class="btn back-btn" data-position="bottom" data-delay="200"
data-tooltip="PDF">
<span>PDF</span></a>

</div>
<div  id="stockpdf">
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
</div>


<script>
  const button = document.getElementById('download-button');

  function generatePDF() {
      // Choose the element that your content will be rendered to.
      const element = document.getElementById('stockpdf');
      // Choose the element and save the PDF for your user.
      html2pdf().from(element).save();
  }

  button.addEventListener('click', generatePDF);

</script>

@stop
