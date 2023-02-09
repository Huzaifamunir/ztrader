@extends('template')
<style>
.toolbar {
    float: left;
}
.input-field{
    display:none;
}
.dataTables_filter input{
        background-color: transparent !important;
    border: none !important;
    border-bottom: 1px solid #9e9e9e !important;
    border-radius: 0 !important;
    outline: none !important;
    height: 1.5rem !important; 
    width: 100% !important;
    font-size: 1rem !important;
    margin: 0 0 20px 0 !important;
    padding: 0 !important;
    -webkit-box-shadow: none;
    box-shadow: none !important;
    -webkit-box-sizing: content-box;
    box-sizing: content-box;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}
.dataTables_filter input:focus{
        border-bottom: 1px solid #9fa8da !important;
    box-shadow: 0 1px 0 0 #9fa8da !important;
}
.dataTables_filter{
      position: absolute;
    top: -32px;
    right: 7px;
}
.flexdiv{
    display:flex;
    align-items:center;
    gap:10px;
}
.flexdiv .add-btn , .flexdiv .back-btn{ 
    display: flex;
    width: max-content;
    align-items: center;
}
.dataTables_filter label{
    font-size: 18px;
    color: #000;
    display: flex;
}

table.dataTable tbody td{
    padding: 20px 10px !important;
}

@media(max-width:490px){
    .searchnav{
        min-height:110px !important;
    }
    .dataTables_filter{
            left: 0;
    top: -43px;
    padding: 0px 13px;
    }
   
}
</style>
@section('section1')
  
  <br>
  @component('components.index_header', ['entity'=>'payment'])
    @slot('column_list')
      <div class="input-field col s5">
        {!! Form::select('column', [
          'id' => 'Payment #', 
        ], 'id', ['placeholder' => 'Select Column', 'required' => 'required']) !!}  
      </div>
    @endslot
  @endcomponent
  
  <div class="z-depth-5" style="padding:1%;background-color: white;">
    
    @if($Payments->isEmpty())
      <center>
        <h3 class="thin">No Record Found !</h3>
      </center>  
    @else

      <table class="highlight bordered display" id="paymentTable">
        <caption>
          <h3 class="thin">
            <span class="mdi mdi-currency-eur"></span>
            Payments
          </h3>
        </caption>
        <thead>
          <tr>
              <th hidden>No#</th>
            <th>Date</th>
            <th>Payment #</th>
            <th>Received By</th>
            <th>Payer</th>
            <th style="max-width:250px;">Transaction Mode</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @foreach($Payments as $Payment)
            <tr>
                <td hidden>{{ $i++}}</td>
              <td>
                {{ $Payment['created_at']->format('d-M-Y') }}
              </td>

              <td>
                ZR_{{ str_pad($Payment['id'], 3, "0", STR_PAD_LEFT) }}
              </td>

              <td>
                {{ $Payment['receiver']['person']['first_name']." ".$Payment['receiver']['person']['last_name'] }}
              </td>

              <td>
                {{ $Payment['payer']['person']['first_name']." ".$Payment['payer']['person']['last_name'] }}
              </td>
              
              @if($Payment['transaction_mode']=="Bank")
                <td>
                  {{ $Payment['transaction_mode'] }}
                  &#40;{{ $Payment['remarks'] }}&#41;
                </td>
              @else
                <td>{{ $Payment['transaction_mode'] }}</td>
              @endif

              <td>
                {{ $Payment['amount'] }}
              </td>

              <td>
                <a class="action-btn edit-btn" href="{{ route('payment.edit', [$Payment['id']]) }}">
                  <span class="mdi mdi-pen"></span>
                </a>
                <a class="action-btn single-btn" href="{{ route('payment.show', [$Payment['id']]) }}">
                  <span class="mdi mdi-chevron-right"></span>
                </a>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    @endif  

  
  </div>  
@stop 
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
  <script>
      $(document).ready(function () {
    $('#paymentTable').DataTable({
         "pageLength":25,
                order: [[0, 'asc']],
        dom: '<"toolbar">frtip',
    });
 
    $('div.toolbar').html('');
});
  </script>