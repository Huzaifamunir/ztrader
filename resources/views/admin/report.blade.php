@extends('template')

@section('section1')
 

  <div class='col s12 m12 l12'>
    <a class="btn form-btn" href="{{ url(URL::previous()) }}">
        <span class="mdi mdi-arrow-left"></span>
    </a>

    <a class='btn form-btn' href="{{ route(Route::currentRouteName(),'report') }}">
        <span class='mdi mdi-reload'></span>
    </a>
    <span class='btn form-btn' onclick="print_this('stock_container')">
        <span class='mdi mdi-printer'></span>
    </span>

    <a id="download-button" class="btn form-btn" data-position="bottom" data-delay="200"
    data-tooltip="PDF">
    <span>PDF</span></a>
</div>

  <div class="col s12 m12 l12" style="background: white;" id="stock_container">
    
    @if($Clients->isEmpty())
      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

  
    <div id="reportpdf">

      <table class="highlight bordered" id="clientTable">
        
        <caption>
          <h3 class="thin" style="display:inline;">
            <span class="mdi mdi-account-star"></span>
            Clients Report ({{ $total_products }})
          </h3>
        
        </caption>
        
        <thead>
          <tr>
            
            <th style="width:50px; padding-left:30px;">No.</th>
            <th style="width:100px;">Name</th>
            <th style="width:100px;">Contact</th>
            <th style="width:100px;">Email</th>
            <th style="width:100px;">City</th>
            <th style="width:100px;">Current Balance</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Clients as $Client)

            <tr>

              <td style="padding-left:30px;">{{ $loop->iteration }}</td>
              
              <td> {{$Client->name}} </td>
              <td>{{ $Client->mobileno }}</td>
              <td> {{$Client->email}} </td>

              @if ($Client->city_id == null)

              <td></td>

              @else

              <td>

                <?php $get_city=\App\Models\City::where(['id' => $Client->city_id])->first();?>
           
                 {{$get_city->name}} 
                </td>
                
              @endif
             
              <td>{{ $Client->current_bal }}</td>
            
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif 
    
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
  <script type="text/javascript">
  
    function sortTable(table, order) {
    var asc   = order === 'asc',
        tbody = table.find('tbody');
    
    tbody.find('tr').sort(function(a, b) {
        if (asc) {
            return $('td:first', a).text().localeCompare($('td:first', b).text());
        } else {
            return $('td:first', b).text().localeCompare($('td:first', a).text());
        }
    }).appendTo(tbody);
}

sortTable($('#clientTable'),'asc');

function printPayment(){
 window.print();
}

  </script> 


<script>
  const button = document.getElementById('download-button');

  function generatePDF() {
      const element = document.getElementById('reportpdf');
      html2pdf().from(element).save();
  }

  button.addEventListener('click', generatePDF);

</script>
@stop 