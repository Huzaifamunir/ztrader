@extends('template')

@section('section1')

<div class="col s12 m12 l12" style="height:10px;"></div>
    
<div class='col s12 m12 l12'>
    <a class="btn form-btn" href="{{ url(URL::previous()) }}">
        <span class="mdi mdi-arrow-left"></span>
    </a>
 
    <a class='btn form-btn' href="{{ route(Route::currentRouteName()) }}">
        <span class='mdi mdi-reload'></span>
    </a>
    <span class='btn form-btn' onclick="print_this('stock_container')">
        <span class='mdi mdi-printer'></span>
    </span>

    <a id="download-button"class='btn form-btn' data-position="bottom" data-delay="200"
    data-tooltip="PDF">
    <span>PDF</span></a>
</div>


<div id="stockpdf" style="padding:10px;">

<div class="col s12 m12 l12" style="background: white;" id="stock_container">
    <div class="col s12 m12 l12" align="center">
      <h4>Current Stock &nbsp;&nbsp;&nbsp;&nbsp;<span style="display:inline;" >({{ $total_products }})</span> </h4>

    </div>

  <div class="col s12 m12 l12" style="font-size:20px;">
      <table class="bordered">
        <caption>
        </caption>
        <thead>
          <tr>
            <th style="width:80px; padding-left:30px;">No.</th>
            <th style="width:300px;">Product Name</th>
            <th style="width:50px;">Stock</th>
          </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
          <tr>
              <td style="padding-left:30px;">{{ $loop->iteration }}</td>
              <td>{{ $product->model }}</td>
              <td>{{ $product->current_stock }}</td>
          </tr>
            @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
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

